<?php


namespace SyedNasharudin\MalakatPay\Models;

use SyedNasharudin\MalakatPay\HttpClient\APIClient;
use SyedNasharudin\MalakatPay\MalakatPayClient\MalakatPayClient;

class DirectPay
{
    /**
     * @var APIClient
     */
    protected $client;

    protected $path = "collections";

    protected $collectionId = null;

    public function __construct(MalakatPayClient $request)
    {
        $this->client = $request->getClient();
    }

    /**
     * @param string $collection_code
     * @return DPPayee
     */
    public function payee(string $collection_code)
    {
        $this->collectionId = $collection_code;
        return new DirectPayPayee($this);
    }

    public function payer(string $collection_code)
    {
        $this->collectionId = $collection_code;
        return new DirectPayPayer($this);
    }

    /**
     * @return null
     */
    public function getCollectionId()
    {
        if (!$this->collectionId) {
            throw new \RuntimeException("Collection Code cant be empty");
        }

        return $this->collectionId;
    }

    /**
     * @return APIClient
     */
    public function getClient(): APIClient
    {
        return $this->client;
    }
}
