<?php


namespace SyedNasharudin\MalakatPay\Models;


use SyedNasharudin\MalakatPay\HttpClient\APIClient;
use SyedNasharudin\MalakatPay\HttpClient\PayResponse;
use SyedNasharudin\MalakatPay\MalakatPayClient;
use SyedNasharudin\MalakatPay\Utils\MalakatPayUtils;
use SyedNasharudin\MalakatPay\Utils\RPUtils;

class Collection
{
    /**
     * @var APIClient
     */
    protected $client;

    protected $path = "collections";

    public function __construct(MalakatPayClient $request)
    {
        $this->client = $request->getClient();
    }

    /**
     * Create Collection
     *
     * @param $collection_name
     * @return PayResponse
     */
    public function create(string $collection_name): PayResponse
    {
        return $this->client
            ->urlSegment($this->path)
            ->postMethod()
            ->setRequestBody([
                'name' => $collection_name
            ])
            ->fetch();
    }

    /**
     * Fetch all Collections
     *
     * @param array $extras
     * @param string $include
     * @return PayResponse
     */
    public function fetchList(array $extras = [], string $include = 'organization'): PayResponse
    {
        return $this->client
            ->urlSegment($this->path, array_merge([
                'include' => $include,
            ], MalakatPayUtils::buildBodyRequest($extras)))
            ->fetch();
    }

    /**
     * Fetch all collection by code
     *
     * @param string $code
     * @param string $include
     * @return PayResponse
     */
    public function fetchByCode(string $code, string $include = 'organization'): PayResponse
    {
        return $this->client
            ->urlSegment($this->path."/$code", [
                'include' => $include
            ])
            ->fetch();
    }

    /**
     * Update collection name
     *
     * @param int $collection_id
     * @param string $collection_name
     * @param string $include
     * @return PayResponse
     */
    public function updateCollectionName(int $collection_id, string $collection_name, string $include = 'organization'): PayResponse
    {
        return $this->client
            ->patchMethod()
            ->urlSegment($this->path."/$collection_id", [
                'include' => $include
            ])
            ->setRequestBody([
                'name' => $collection_name
            ])
            ->fetch();
    }
}
