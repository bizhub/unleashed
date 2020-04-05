<?php

namespace Bizhub\Unleashed;

use Bizhub\Unleashed\Facades\Unleashed;

class StockAdjustments
{
    /**
     * Get list of stock adjustments
     *
     * @param string|array|null $query
     * @return array
     */
    public static function get($query = null)
    {
        return Unleashed::get('StockAdjustments', $query)->Items;
    }

    /**
     * Find stock adjustment
     *
     * @param string $guid
     * @param string|array|null $query
     * @return array
     */
    public static function find($guid, $query = null)
    {
        return Unleashed::get('StockAdjustments/' . $guid, $query);
    }

    /**
     * Create stock adjustment
     *
     * @param string $guid
     * @param array $data
     * @return array
     */
    public static function create($guid, $data)
    {
        return Unleashed::post('StockAdjustments/' . $guid, $data);
    }
}
