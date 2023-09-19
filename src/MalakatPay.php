<?php


namespace MalakatPay;

use SyedNasharudin\MalakatPay\MalakatPayClient\Client;
use SyedNasharudin\MalakatPay\MalakatPayClient\MalakatPayClient;

class MalakatPay
{
    /**
     * @var MalakatPayClient
     */
    protected $pay;

    public function __construct()
    {
        $this->pay = new MalakatPayClient();
    }

    /**
     * @param array $config
     * @return Client
     */
    public static function make(array $config = []) : MalakatPayClient
    {
        $client = (new self())->pay;

        if (function_exists('config')) {
            $config = empty($config) ? config('malakatpay'): $config;
        }

        if (!isset($config['api_key'])) {
            throw new \RuntimeException("Api Key is required");
        }

        if (!isset($config['signature_key'])) {
            throw new \RuntimeException("Signature Key is required");
        }

        $client->setApiKey($config['api_key']);
        $client->setSignatureKey($config['signature_key']);

        if (isset($config['endpoint'])) {
            $client->setEndpoint($config['endpoint']);
        }

        if ($config['is_sandbox'] ?? true) {
            $client->useSandBox();
        }

        return $client;
    }
}
