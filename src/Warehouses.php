<?php

namespace Bizhub\Unleashed;

use Bizhub\Unleashed\Facades\Unleashed;

class Warehouses
{
    /**
     * Get list of warehouses
     *
     * @param string|array|null $query
     * @return array
     */
    public static function get($query = null)
    {
        return Unleashed::getJson('Warehouses', $query)->Items;
    }
}
