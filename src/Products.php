<?php

namespace Bizhub\Unleashed;

class Products
{
    /**
     * Get list of products
     *
     * @param string|array|null $query
     * @return array
     */
    public static function get($query = null)
    {
        return resolve('Bizhub\Unleashed\Unleashed')->getJson('Products', $query)->Items;
    }

    /**
     * Find a single product
     *
     * @param string $guid
     * @param string|null $query
     * @return array
     */
    public static function find($guid, $query = null)
    {
        return resolve('Bizhub\Unleashed\Unleashed')->getJson('Products/' . $guid, $query);
    }
}
