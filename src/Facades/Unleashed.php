<?php

namespace Bizhub\Unleashed\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string getBaseUrl()
 * @method static \Illuminate\Http\Client\PendingRequest getHttpClient()
 * @method static string getSignature(array $query = [])
 * @method static array get($url, array $query = [])
 * @method static array post($url, array $data)
 *
 * @see \Bizhub\Unleashed\Unleashed
 */
class Unleashed extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Bizhub\Unleashed\Unleashed::class;
    }
}