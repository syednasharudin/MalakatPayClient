<?php

use MalakatPay\MalakatPay;

require_once __DIR__ .'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

$response = MalakatPay::make([
    'api_key' => getenv('MALAKATPAY_API_KEY'),
    'signature_key' => getenv('MALAKATPAY_X_SIGNATURE')
])
    ->customer()
    ->getList();

header('Content-type: application/json');
echo $response;
