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
        return Unleashed::getJson('StockAdjustments', $query)->Items;
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
        return Unleashed::getJson('StockAdjustments/' . $guid, $query);
    }

    /**
     * Create stock adjustment
     *
     * @param string $guid
     * @param array $data
     * @return ResponseInterface
     */
    public static function create($guid, $data)
    {
        return Unleashed::postJson('StockAdjustments/' . $guid, $data);
    }
}
