<?php

namespace Bizhub\Unleashed;

use Bizhub\Unleashed\Facades\Unleashed;

class StockAdjustments
{
    /**
     * Get list of stock adjustments
     *
     * @param  array  $query
     * @return array
     */
    public static function get(array $query = []): array
    {
        return Unleashed::get('StockAdjustments', $query)['Items'] ?? [];
    }

    /**
     * Find stock adjustment
     *
     * @param  string  $guid
     * @param  array  $query
     * @return array
     */
    public static function find($guid, array $query = []): array
    {
        return Unleashed::get('StockAdjustments/' . $guid, $query);
    }

    /**
     * Create stock adjustment
     *
     * @param  string  $guid
     * @param  array  $data
     * @return array
     */
    public static function create($guid, array $data): array
    {
        return Unleashed::post('StockAdjustments/' . $guid, $data);
    }
}
