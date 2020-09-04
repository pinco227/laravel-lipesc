<?php
function presentPrice($a)
{
    $fmt = new \NumberFormatter('en_EN', \NumberFormatter::CURRENCY);

    return $fmt->formatCurrency($a, "EUR") . "\n";
}
function setActiveCategory($category, $output = 'active')
{
    return request()->category == $category ? $output : '';
}
