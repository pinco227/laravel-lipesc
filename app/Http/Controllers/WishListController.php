<?php

namespace App\Http\Controllers;

use App\Product;
use Validator;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    public function index()
    {
        $mightAlsoLike = Product::MightAlsoLike()->get();
        $wish_list = app('wishlist');
        $items         = $wish_list->getContent();
        return view('wishlist')->with('items', $items)->with('mightAlsoLike', $mightAlsoLike);
    }

    public function add()
    {
        $wish_list = app('wishlist');
        $id = request('id');
        $name = request('name');
        $price = request('price');
        $qty = request('qty');

        $wish_list->add($id, $name, $price, $qty, array())->associate('App\Product');
    }

    public function delete($id)
    {
        $wish_list = app('wishlist');

        $wish_list->remove($id);

        if ($wish_list->isEmpty()) {
            return redirect()->route('shop.index')->with('error', 'Wishlist is empty!');
        } else {
            return redirect()->route('wishlist.index')->with('error', 'Item was removed from wishlist!');
        }
    }

    public function details()
    {
        $wish_list = app('wishlist');

        return response(array(
            'success' => true,
            'data' => array(
                'total_quantity' => $wish_list->getTotalQuantity(),
                'sub_total' => $wish_list->getSubTotal(),
                'total' => $wish_list->getTotal(),
            ),
            'message' => "Get wishlist details success."
        ), 200, []);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'numeric|required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('wishlist.index')->with('error', 'Wishlist quantities cannot be updated!');
        }


        $wish_list = app('wishlist');

        $wish_list->update($id, [
            'quantity' => [
                'relative' => false,
                'value' => $request->quantity
            ],
        ]);

        return redirect()->route('wishlist.index')->with('success', 'Wishlist quantity updated!');
    }

    public function moveToCart($id)
    {
        $wish_list = app('wishlist');
        $item=$wish_list->get($id);
        $wish_list->remove($id);

        \Cart::add($item->id, $item->name, $item->price, $item->quantity)->associate('App\Product');

        return redirect()->route('cart.index')->with('success', 'Item moved to Cart!');
    }
}
