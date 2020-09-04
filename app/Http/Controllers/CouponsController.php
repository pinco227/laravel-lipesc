<?php

namespace App\Http\Controllers;

use App\Coupon;
use Darryldecode\Cart\CartCondition;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon = Coupon::findByCode($request->coupon_code);
        if (! $coupon) {
            return redirect()->route('checkout.index')->withErrors('Invalid coupon code. Please try again!');
        }

        $condition = new CartCondition([
            'name' => $coupon->code,
            'type' => $coupon->type,
            'target' => 'total', // this condition will be applied to cart's subtotal when getSubTotal() is called.
            'value' => '-'.$coupon->discount(\Cart::getSubTotal())
        ]);

        \Cart::condition($condition);

        return redirect()->route('checkout.index')->with('success', 'Coupon has been applied!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupon  $code
     * @return \Illuminate\Http\Response
     */
    public function delete($code)
    {
        $coupon = Coupon::findByCode($code);
        if (! $coupon) {
            return redirect()->route('checkout.index')->withErrors('Invalid coupon code. Please try again!');
        }

        \Cart::removeCartCondition($code);

        return redirect()->route('checkout.index')->with('success', 'Coupon has been removed!');
    }
}
