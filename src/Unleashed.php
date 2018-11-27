<?php

namespace Bizhub\Unleashed;

use Carbon\Carbon;
use SimpleXMLElement;
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
    protected function getSignature($query)
    {
        return base64_encode(hash_hmac('sha256', $query, $this->apiKey, true));
    }

    /**
     * Get headers
     *
     * @param string $query
     * @param string $format
     * @return array
     */
    protected function getHeaders($query, $format)
    {
        return [
            'Content-Type' => 'application/' . $format,
            'Accept' => 'application/' . $format,
            'api-auth-id' => $this->apiId,
            'api-auth-signature' => $this->getSignature($query)
        ];
    }

    /**
     * Send request to api endpoint
     *
     * @param string $endpoint
     * @param string|array $query
     * @param string $type
     * @param string $format
     * @return void
     */
    protected function request($endpoint, $query, $type, $format)
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

        return $this->client->request($type, $endpoint, [
            'headers' => $this->getHeaders($query, $format)
        ]);
    }

    /**
     * Get json response
     *
     * Pagination, Items
     *
     * @param string $endpoint
     * @param string|array $query
     * @return array
     */
    public function getJson($endpoint, $query = null)
    {
        return json_decode(
            $this->request($endpoint, $query, 'GET', 'json')
                ->getBody()
                ->getContents()
        );
    }

    /**
     * Get xml response
     *
     * Pagination, Products
     *
     * @param string $endpoint
     * @param string|array $query
     * @return array
     */
    public function getXml($endpoint, $query = null)
    {
        return new SimpleXMLElement(
            $this->request($endpoint, $query, 'GET', 'xml')
                ->getBody()
                ->getContents()
        );
    }

    /**
     * Get list of products
     *
     * @param string|array $query
     * @param integer $page
     * @param integer $perPage
     * @return array
     */
    public function getProducts($query = null, $page = 1, $perPage = 200)
    {
        $products = $this->getJson('products', $query);

        return $products->Items;
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
