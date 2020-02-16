<?php

namespace TaffoVelikoff\HotCoffee\Facades;

use Illuminate\Support\Facades\Facade;

class HotCoffee extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'hotcoffee';
    }
}