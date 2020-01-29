<?php

namespace Bizhub\Unleashed;

use Bizhub\Unleashed\Facades\Unleashed;

class BillOfMaterials
{
    /**
     * Get list of bill of materials
     *
     * @param string|array|null $query
     * @return array
     */
    public static function get($query = null)
    {
        return Unleashed::getJson('BillOfMaterials', $query)->Items;
    }

    /**
     * Find a single bill of materials
     *
     * @param string $guid
     * @param string|null $query
     * @return array
     */
    public static function find($guid, $query = null)
    {
        return Unleashed::getJson('BillOfMaterials/' . $guid, $query);
    }
}
