<?php

namespace Bizhub\Unleashed;

use Bizhub\Unleashed\Facades\Unleashed;

class SalesOrders
{
    /**
     * Get list of sales orders
     *
     * @param  array  $query
     * @return array
     */
    public static function get(array $query = []): array
    {
        return Unleashed::get('SalesOrders', $query)['Items'];
    }

    /**
     * Find a single sales order
     *
     * @param  string  $guid
     * @param  array  $query
     * @return array
     */
    public static function find($guid, array $query = []): array
    {
        return Unleashed::get('SalesOrders/' . $guid, $query);
    }
}
