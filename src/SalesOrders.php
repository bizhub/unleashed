<?php

namespace Bizhub\Unleashed;

class SalesOrders
{
    /**
     * Get list of sales orders
     *
     * @param string|array|null $query
     * @return array
     */
    public static function get($query = null)
    {
        return resolve('Bizhub\Unleashed\Unleashed')->getJson('SalesOrders', $query)->Items;
    }

    /**
     * Find a single sales order
     *
     * @param string $guid
     * @param string|null $query
     * @return array
     */
    public static function find($guid, $query = null)
    {
        return resolve('Bizhub\Unleashed\Unleashed')->getJson('SalesOrders/' . $guid, $query);
    }
}
