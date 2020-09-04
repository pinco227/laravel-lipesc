<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function presentPrice()
    {
        $fmt = new \NumberFormatter('en_EN', \NumberFormatter::CURRENCY);

        return $fmt->formatCurrency($this->price, "EUR") . "\n";
    }

    public function scopeMightAlsoLike($query)
    {
        return $query->inRandomOrder()->take(4);
    }
}
