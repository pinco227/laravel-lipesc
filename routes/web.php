<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', 'LandingPageController@index')->name('landing-page');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/shop', 'ShopController@index')->name('shop.index');
Route::get('/product/{product}', 'ShopController@show')->name('shop.show');

Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart', 'CartController@add')->name('cart.add');
Route::get('/cart/clear', 'CartController@clear')->name('cart.clear');
Route::delete('/cart/{id}', 'CartController@delete')->name('cart.delete');
Route::put('/cart/{id}', 'CartController@update')->name('cart.update');
Route::post('/cart/moveToWishList/{product}', 'CartController@moveToWishList')->name('cart.moveToWishList');

Route::get('/wishlist', 'WishListController@index')->name('wishlist.index');
Route::post('/wishlist', 'WishListController@add')->name('wishlist.add');
Route::delete('/wishlist/{id}', 'WishListController@delete')->name('wishlist.delete');
Route::put('/wishlist/{id}', 'WishListController@update')->name('wishlist.update');
Route::post('/wishlist/moveToCart/{product}', 'WishListController@moveToCart')->name('wishlist.moveToCart');

Route::post('/coupon', 'CouponsController@store')->name('coupon.store');
Route::delete('/coupon/{code}', 'CouponsController@delete')->name('coupon.delete');

Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
Route::post('/checkout', 'CheckoutController@pay')->name('checkout.pay');
Route::get('/thank-you', 'ConfirmationController@index')->name('confirmation.index');
