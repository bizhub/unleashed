<?php

namespace Bizhub\Unleashed;

use Bizhub\Unleashed\Facades\Unleashed;

class StockOnHand
{
    /**
     * Get list of stock on hand
     *
     * @param  array  $query
     * @return array
     */
    public static function get(array $query = []): array
    {
        return Unleashed::get('StockOnHand', $query)['Items'];
    }

    /**
     * Find stock on hand for a product
     *
     * @param  string  $productId
     * @param  array  $query
     * @return array
     */
    public static function find($productId, array $query = []): array
    {
        return Unleashed::get('StockOnHand/' . $productId, $query);
    }
}
