<?php

namespace Bizhub\Unleashed\Facades;

use Illuminate\Support\Facades\Facade;

class Unleashed extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Bizhub\Unleashed\Unleashed::class;
    }
}