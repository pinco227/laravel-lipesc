<?php

namespace App\Http\Controllers;

use App\Product;
//use NumberFormatter;
//use Darryldecode\Cart\Cart;
use Validator;
use Illuminate\Http\Request;
use Darryldecode\Cart\CartCondition;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mightAlsoLike = Product::MightAlsoLike()->get();
        $items         = \Cart::getContent();
        $cartConditions = \Cart::getConditions();
        return view('cart')->with('mightAlsoLike', $mightAlsoLike)->with('items', $items)->with('cartConditions', $cartConditions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        \Cart::add($request->id, $request->name, $request->price, $request->quantity)->associate('App\Product');

        return redirect()->route('cart.index')->with('success', 'Item was added to your cart!');
    }

    /**
     * Add Cart Condition
     *
     * @return void
     */
    public function addCondition()
    {
        // $userId = 1; // get this from session or wherever it came from

        /** @var \Illuminate\Validation\Validator $v */
        $v = validator(request()->all(), [
            'name' => 'required|string',
            'type' => 'required|string',
            'target' => 'required|string',
            'value' => 'required|string',
        ]);

        if ($v->fails()) {
            return response(array(
                'success' => false,
                'data' => [],
                'message' => $v->errors()->first()
            ), 400, []);
        }

        $name = request('name');
        $type = request('type');
        $target = request('target');
        $value = request('value');

        $cartCondition = new CartCondition([
            'name' => $name,
            'type' => $type,
            'target' => $target, // this condition will be applied to cart's subtotal when getSubTotal() is called.
            'value' => $value,
            'attributes' => array()
        ]);

        // \Cart::session($userId)->condition($cartCondition);
        \Cart::condition($cartCondition);

        return response(array(
            'success' => true,
            'data' => $cartCondition,
            'message' => "condition added."
        ), 201, []);
    }
    /**
     * Clear Cart Conditions
     *
     * @return void
     */
    public function clearCartConditions()
    {
        //$userId = 1; // get this from session or wherever it came from

        // \Cart::session($userId)->clearCartConditions();
        \Cart::clearCartConditions();

        return response(array(
            'success' => true,
            'data' => [],
            'message' => "cart conditions cleared."
        ), 200, []);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'numeric|required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('cart.index')->with('error', 'Cart quantities cannot be updated!');
        }

        \Cart::update($id, [
            'quantity' => [
                'relative' => false,
                'value' => $request->quantity
            ],
        ]);

        return redirect()->route('cart.index')->with('success', 'Cart updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        \Cart::remove($id);
        if (\Cart::isEmpty()) {
            return redirect()->route('shop.index')->with('error', 'Item was removed from cart! Cart is empty!');
        } else {
            return redirect()->route('cart.index')->with('error', 'Item was removed from cart!');
        }
    }
    /**
     * Move product to wishlist
     *
     * @param [type] $id
     * @return void
     */
    public function moveToWishList($id)
    {
        $item=\Cart::get($id);
        \Cart::remove($id);

        $wish_list = app('wishlist');
        $wish_list->add($item->id, $item->name, $item->price, $item->quantity, array())->associate('App\Product');

        return redirect()->route('wishlist.index')->with('success', 'Item moved to WishList!');
    }

    /**
     * Clears Cart
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function clear()
    {
        \Cart::clear();
        \Cart::clearCartConditions();
        return redirect()->route('shop.index')->with('error', 'Shopping Cart emptied!');
    }

    public function details()
    {
        //$userId = 1; // get this from session or wherever it came from

        // get subtotal applied condition amount
        // $conditions = \Cart::session($userId)->getConditions();
        $conditions = \Cart::getConditions();


        // get conditions that are applied to cart sub totals
        $subTotalConditions = $conditions->filter(function (CartCondition $condition) {
            return $condition->getTarget() == 'subtotal';
        })->map(function (CartCondition $c) /* use ($userId) */ {
            return [
                'name' => $c->getName(),
                'type' => $c->getType(),
                'target' => $c->getTarget(),
                'value' => $c->getValue(),
            ];
        });

        // get conditions that are applied to cart totals
        $totalConditions = $conditions->filter(function (CartCondition $condition) {
            return $condition->getTarget() == 'total';
        })->map(function (CartCondition $c) {
            return [
                'name' => $c->getName(),
                'type' => $c->getType(),
                'target' => $c->getTarget(),
                'value' => $c->getValue(),
            ];
        });

        return response(array(
            'success' => true,
            'data' => array(
                'total_quantity' => \Cart::getTotalQuantity(), //session($userId)->
                'sub_total' => \Cart::getSubTotal(), //session($userId)->
                'total' => \Cart::getTotal(), //session($userId)->
                'cart_sub_total_conditions_count' => $subTotalConditions->count(),
                'cart_total_conditions_count' => $totalConditions->count(),
            ),
            'message' => "Get cart details success."
        ), 200, []);
    }
}
