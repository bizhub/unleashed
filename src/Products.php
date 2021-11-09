<?php

namespace Bizhub\Unleashed;

use Bizhub\Unleashed\Facades\Unleashed;

class Products
{
    /**
     * Get list of products
     *
     * @param  array  $query
     * @return array
     */
    public static function get(array $query = []): array
    {
        return Unleashed::get('Products', $query)['Items'] ?? [];
    }

    /**
     * Find a single product
     *
     * @param  string  $guid
     * @param  string|null  $query
     * @return array
     */
    public static function find($guid, array $query = []): array
    {
        return Unleashed::get('Products/' . $guid, $query);
    }
}
