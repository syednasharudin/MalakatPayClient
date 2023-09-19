<?php

namespace SyedNasharudin\MalakatPay;

use SyedNasharudin\MalakatPay\HttpClient\APIClient;
use SyedNasharudin\MalakatPay\Models\Collection;
use SyedNasharudin\MalakatPay\Models\Bill;
use SyedNasharudin\MalakatPay\Models\Customer;
use SyedNasharudin\MalakatPay\Models\DirectPay;
use SyedNasharudin\MalakatPay\Models\Product;

class MalakatPayClient
{
    /**
     * MalakatPay API Key.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * MalakatPay X-Signature Key.
     *
     * @var string|null
     */
    protected $signatureKey;

    /**
     * MalakatPay X-Signature Key.
     *
     * @var string|null
     */
    protected $is_sandbox;

    /**
     * MalakatPay Headers
     *
     * @var array
     */
    protected $headers = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json'
    ];

    /**
     * MalakatPay API endpoint.
     *
     * @var string
     */
    protected $endpoint = 'https://console-api.malakatpay.com/api';

    /**
     * API Request
     *
     * @var APIClient
     */
    protected $client;

    public function __construct()
    {
        $this->client = new APIClient();
        $this->client->setEndpoint($this->endpoint);
    }

    public function useSandBox()
    {
        $this->client->setEndpoint("https://stg-console-api.malakatpay.com/api");
    }

    /**
     * @param string|null $signatureKey
     */
    public function setSignatureKey(?string $signatureKey): void
    {
        $this->signatureKey = $signatureKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey(string $apiKey): void
    {
        $this->apiKey = $apiKey;
        $this->client->setHeader('Authorization', 'Bearer '.$apiKey);
    }

    /**
     * @return string
     */
    public function getSignatureKey(): string
    {
        return $this->signatureKey;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     */
    public function setEndpoint(string $endpoint): void
    {
        $this->client->setEndpoint($endpoint);
    }


    /**
     * @return APIClient
     */
    public function getClient(): APIClient
    {
        return $this->client;
    }

    public function collection() : Collection
    {
        return new Collection($this);
    }

    public function bill() : Bill
    {
        return new Bill($this);
    }

    public function customer() : Customer
    {
        return new Customer($this);
    }

    public function product() : Product
    {
        return new Product($this);
    }

    public function directPay() : DirectPay
    {
        return new DirectPay($this);
    }

    public function isCheckSumValid(array $request)
    {
        $checksum = $request['signature'];
        ksort($request);
        unset($request['signature']);

        $keyValues = array_map(function ($key, $value) {
            return "$key:$value";
        }, array_keys($request), $request);

        $generatedSHA = hash_hmac('sha256', implode('|', $keyValues), $this->getSignatureKey());

        return $generatedSHA == $checksum;
    }
}
