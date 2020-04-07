<?php

namespace Bizhub\Unleashed;

use Carbon\Carbon;
use GuzzleHttp\Client;

class Unleashed
{
    /**
     * Guzzle client
     *
     * @var Client
     */
    protected $client;

    /**
     * Api id
     *
     * @var string
     */
    protected $apiId;

    /**
     * Api key
     *
     * @var string
     */
    protected $apiKey;

    /**
     * Constructor
     *
     * @param string $apiId
     * @param string $apiKey
     */
    public function __construct($apiId, $apiKey)
    {
        $this->apiId = $apiId;
        $this->apiKey = $apiKey;

        $this->client = new Client([
            'base_uri' => 'https://api.unleashedsoftware.com/'
        ]);
    }

    /**
     * Get signature
     *
     * @param  string $query
     * @return string
     */
    protected function getSignature($query = '')
    {
        return base64_encode(hash_hmac('sha256', $query, $this->apiKey, true));
    }

    /**
     * Get request
     *
     * @param string $endpoint
     * @param string|array $query
     * @return void
     */
    public function get($endpoint, $query = '')
    {
        if (is_array($query)) {
            foreach ($query as $key => $val) {
                $query[$key] = "$key=$val";
            }
            $query = implode('&', $query);
        }

        if (!empty($query)) {
            $endpoint = $endpoint . '?' . $query;
        }

        return json_decode(
            $this->client->request('GET', $endpoint, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'api-auth-id' => $this->apiId,
                    'api-auth-signature' => $this->getSignature($query)
                ]
            ])
            ->getBody()
            ->getContents()
        );
    }

    /**
     * Post request
     *
     * @param string $endpoint
     * @param array $data
     * @return array
     */
    public function post($endpoint, $data)
    {
        return json_decode(
            $this->client->request('POST', $endpoint, [
                'headers' => [
                    'Accept' => 'application/json',
                    'api-auth-id' => $this->apiId,
                    'api-auth-signature' => $this->getSignature()
                ],
                'form_params' => $data
            ])
            ->getBody()
            ->getContents()
        );
    }

    /**
     * Format date based on Unleashed standards (UTC)
     *
     * @param null|string|Carbon $time
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
     * @param string $unleashedDate
     * @param string $timezone
     * @param string $format
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
