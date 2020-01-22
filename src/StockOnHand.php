<?php

namespace Bizhub\Unleashed;

use Bizhub\Unleashed\Facades\Unleashed;

class StockOnHand
{
    /**
     * Get list of stock on hand
     *
     * @param string|array|null $query
     * @return array
     */
    public static function get($query = null)
    {
        return Unleashed::getJson('StockOnHand', $query)->Items;
    }

    /**
     * Find stock on hand for a product
     *
     * @param string $guid
     * @param string|array|null $query
     * @return array
     */
    public static function find($guid, $query = null)
    {
        return Unleashed::getJson('StockOnHand/' . $guid, $query);
    }
}
