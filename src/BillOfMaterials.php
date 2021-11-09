<?php

namespace Bizhub\Unleashed;

use Bizhub\Unleashed\Facades\Unleashed;

class BillOfMaterials
{
    /**
     * Get list of bill of materials
     *
     * @param  array  $query
     * @return array
     */
    public static function get(array $query = []): array
    {
        return Unleashed::get('BillOfMaterials', $query)['Items'] ?? [];
    }

    /**
     * Find a single bill of materials
     *
     * @param  string  $guid
     * @param  array  $query
     * @return array
     */
    public static function find($guid, array $query = []): array
    {
        return Unleashed::get('BillOfMaterials/' . $guid, $query);
    }
}
