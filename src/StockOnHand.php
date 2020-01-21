<?php

namespace Bizhub\Unleashed;

class StockOnHand
{
    /**
     * Find stock on hand for a product
     *
     * @param string $guid
     * @param string|array|null $query
     * @return array
     */
    public static function find($guid, $query = null)
    {
        return resolve('Bizhub\Unleashed\Unleashed')->getJson('StockOnHand/' . $guid, $query);
    }
}
