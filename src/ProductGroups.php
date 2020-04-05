<?php

namespace Bizhub\Unleashed;

use Bizhub\Unleashed\Facades\Unleashed;

class ProductGroups
{
    /**
     * Get list of product groups
     *
     * @param string|array|null $query
     * @return array
     */
    public static function get($query = null)
    {
        return Unleashed::get('ProductGroups', $query)->Items;
    }
}
