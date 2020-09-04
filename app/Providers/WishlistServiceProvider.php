<?php

namespace App\Providers;

use App\DatabaseStorage;
use Darryldecode\Cart\Cart;
use Illuminate\Support\ServiceProvider;

class WishlistServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('wishlist', function ($app) {
            $storage = new DatabaseStorage();
            $events = $app['events'];
            $instanceName = 'wishlist';
            $session_key = '88uuiioo99888';
            return new Cart(
                $storage,
                $events,
                $instanceName,
                $session_key,
                config('shopping_cart')
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
