<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Product;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Exception\MissingParameterException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;
use Validator;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mightAlsoLike = Product::MightAlsoLike()->get();
        $items = \Cart::getContent();
        $cartConditions = \Cart::getConditions();
        return view('checkout')->with('mightAlsoLike', $mightAlsoLike)->with('items', $items)->with('cartConditions', $cartConditions);
    }

    /**
     * Validate Payment.
     *
     * @param Request $request
     * @return void
     */
    public function pay(CheckoutRequest $request)
    {
        $contents = \Cart::getContent()->map(function ($item) {
            return $item->model->slug.', '.$item->quantity;
        })->values()->toJson();
        $conditions = \Cart::getConditions()->map(function ($cond) {
            return $cond->getName().', '.$cond->getType().', '.$cond->getValue();
        })->values()->toJson();

        $validator = Validator::make($request->all(), [
            'cc-number' => 'required',
            'cc-ExpiryMonth' => 'required',
            'cc-ExpiryYear' => 'required',
            'cc-cvc' => 'required'
            //'amount' => 'required',
        ]);
        $input = $request->all();
        if ($validator->passes()) {
            $input = array_except($input, ['_token']);
            //$stripe = \Stripe::setApiKey(env('STRIPE_SECRET'));
            try {
                $token = Stripe::tokens()->create([
                    'card' => [
                        'name' => $request->get('cc-name'),
                        'number' => $request->get('cc-number'),
                        'exp_month' => $request->get('cc-ExpiryMonth'),
                        'exp_year' => $request->get('cc-ExpiryYear'),
                        'cvc' => $request->get('cc-cvc'),
                    ],
                ]);
                if (! isset($token['id'])) {
                    //return 'no token id';
                    return redirect()->route('checkout.index')->with('error', 'error');
                }
                $charge = Stripe::charges()->create([
                    'card' => $token['id'],
                    'currency' => 'EUR',
                    'amount' => \Cart::GetTotal(),
                    'description' => 'Order '.$request->get('cart-id'),
                    'receipt_email' => $request->get('email'),
                    'metadata' => [
                        'contents' => $contents,
                        'conditions' => $conditions,
                        'quantity' => \Cart::getTotalQuantity(),
                    ],
                ]);

                if ($charge['status'] != 'succeeded') {
                    return redirect()->route('checkout.index')->with('error', 'Money not add in wallet!!')->withInput($input);
                }

                // SUCCESSFUL
                \Cart::clear();
                \Cart::clearCartConditions();

                return redirect()->route('confirmation.index')->with('success', 'success');
            } catch (Exception $e) {
                return redirect()->route('checkout.index')->with('error', $e->getMessage())->withInput($input);
            } catch (CardErrorException $e) {
                return redirect()->route('checkout.index')->with('error', $e->getMessage())->withInput($input);
            } catch (MissingParameterException $e) {
                return redirect()->route('checkout.index')->with('error', $e->getMessage())->withInput($input);
            }
        } else {
            return redirect()->route('checkout.index')->with('error', 'Check required fields!')->withInput($input);
        }
    }

    /**
     * Complete order.
     *
     * @return void
     */
}
