<?php

namespace Bizhub\Unleashed;

use Bizhub\Unleashed\Facades\Unleashed;

class ProductGroups
{
    /**
     * Get list of product groups
     *
     * @param  array  $query
     * @return array
     */
    public static function get(array $query = []): array
    {
        return Unleashed::get('ProductGroups', $query, 'GetProductGroups')['Items'] ?? [];
    }
}
