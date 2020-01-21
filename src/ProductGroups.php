<?php

namespace Bizhub\Unleashed;

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
        return resolve('Bizhub\Unleashed\Unleashed')->getJson('ProductGroups', $query)->Items;
    }
}
