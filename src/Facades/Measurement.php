<?php

namespace Bizhub\Unleashed\Facades;

use Illuminate\Support\Facades\Facade;

class Measurement extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Bizhub\Unleashed\Measurement::class;
    }
}
