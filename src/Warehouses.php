<?php

namespace Bizhub\Unleashed;

use Bizhub\Unleashed\Facades\Unleashed;

class Warehouses
{
    /**
     * Get list of warehouses
     *
     * @param  array  $query
     * @return array
     */
    public static function get(array $query = []): array
    {
        return Unleashed::get('Warehouses', $query)['Items'] ?? [];
    }
}
