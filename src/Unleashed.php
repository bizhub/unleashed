<?php

namespace Bizhub\Unleashed;

use Carbon\Carbon;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class Unleashed
{
    /**
     * Constructor
     *
     * @param  string  $apiId
     * @param  string  $apiKey
     */
    public function __construct(
        protected string $apiId,
        protected string $apiKey,
        protected string $partnerName,
    ) {}

    /**
     * Get base api url
     *
     * @return string
     */
    public function getBaseUrl(): string
    {
        return 'https://api.unleashedsoftware.com';
    }

    /**
     * Get Http client
     *
     * @return PendingRequest
     */
    public function getHttpClient(): PendingRequest
    {
        return Http::baseUrl($this->getBaseUrl());
    }

    /**
     * Get signature
     *
     * @param  array  $query
     * @return string
     */
    public function getSignature(array $query = []): string
    {
        return base64_encode(
            hash_hmac(
                'sha256',
                http_build_query($query),
                $this->apiKey,
                true
            )
        );
    }

    /**
     * Get request
     *
     * @param  string  $url
     * @param  array  $query
     * @param  string  $appName
     * @return array
     */
    public function get($url, array $query = [], string $appName = 'unknown'): array
    {
        return json_decode(
            $this
                ->getHttpClient()
                ->withHeaders([
                    'api-auth-id' => $this->apiId,
                    'api-auth-signature' => $this->getSignature($query),
                    'client-type' => $this->partnerName . '/' . $appName,
                ])
                ->acceptJson()
                ->get($url, $query),
            true
        );
    }

    /**
     * Post request
     *
     * @param  string  $url
     * @param  array  $data
     * @param  string  $appName
     * @return array
     */
    public function post($url, array $data, string $appName = 'unknown'): array
    {
        return json_decode(
            $this
                ->getHttpClient()
                ->withHeaders([
                    'api-auth-id' => $this->apiId,
                    'api-auth-signature' => $this->getSignature(),
                    'client-type' => $this->partnerName . '/' . $appName,
                ])
                ->acceptJson()
                ->post($url, $data),
            true
        );
    }

    /**
     * Format date based on Unleashed standards (UTC)
     *
     * @param  null|string|Carbon  $time
     * @return string
     */
    public function generateDate($time = null)
    {
        if ($time === null) {
            $time = Carbon::now('Europe/London');
        } else if (is_string($time)) {
            $time = new Carbon($time, 'Europe/London');
        } else if ($time instanceof Carbon) {
            $time->setTimezone('Europe/London');
        } else {
            return '';
        }

        return $time->format('Y-m-d\TH:i:s.v');
    }

    /**
     * Convert Unleashed date to different timezone
     *
     * @param  string  $unleashedDate
     * @param  string  $timezone
     * @param  string  $format
     * @return string
     */
    public function formatDateForTimezone($unleashedDate, $timezone = 'Pacific/Auckland', $format = 'd/m/Y g:i:sA')
    {
        if (empty($unleashedDate)) {
            return '';
        }

        return (new Carbon($unleashedDate, 'Europe/London'))
            ->setTimezone($timezone)
            ->format($format);
    }
}
