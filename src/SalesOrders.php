<?php

namespace Bizhub\Unleashed;

use Bizhub\Unleashed\Facades\Unleashed;

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
        return Unleashed::get('SalesOrders', $query)->Items;
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
        return Unleashed::get('SalesOrders/' . $guid, $query);
    }
}
