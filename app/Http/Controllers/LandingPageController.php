<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('featured', true)->take(6)->inRandomOrder()->get();

        $onSale = Product::orderBy('price', 'asc')->take(6)->get();

        return view('landing-page')->with([
                'products' => $products,
                'onSale' => $onSale,
            ]);
    }
}
