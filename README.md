# MalakatPay Client Library using PHP Framework

Unofficial SDK for [MalakatPay Payment Gateway](https://www.malakatpay.com/) 

## Directory
* [Installation](#installation)
* [Usages](#usages)

## Installation

### Composer
```
composer require syednasharudin/malakatpay
```
Alternatively, you can specify as a dependency in your project's existing composer.json file
```
{
   "require": {
      "syednasharudin/malakatpay-client": "^1.0.0"
   }
}
```


## Usages
After installing, you need to require Composer's autoloader and add your code.

Setup config
```$xslt
$config = [
    'api_key' => getenv('MALAKATPAY_API_KEY'),
    'signature_key' => getenv('MALAKATPAY_X_SIGNATURE')
];
```

Or use Laravel config file name it as `malakatpay.php` and leave `make()` blank
```
return [
    'api_key' => env('MALAKATPAY_API_KEY'),
    'signature_key' => env('MALAKATPAY_X_SIGNATURE', null),
    'is_sandbox' => env('MALAKATPAY_SANDBOX', env('APP_ENV') != 'production'),
];

```

## Collection

### Create collection
```$xslt
MalakatPay::make()
    ->collection()
    ->create("Collection Name");
```

### Get collections
```$xslt
MalakatPay::make()
    ->collection()
    ->fetchList(); 
```

### Update collection name
```$xslt
MalakatPay::make()
    ->collection()
    ->updateCollectionName("CollectionID", "New Name"); 
```

### Get collections by code
```$xslt
MalakatPay::make()
    ->collection()
    ->fetchByCode("CollectionCode"); 
```


## Bills

### Create Bill
```$xslt
MalakatPay::make()
    ->bill()
    ->makeBill("COLLECTION CODE")
    ->setCustomer("Amirul", "Amirul", "hello@gmail.com", "60123456789", "Melaka")
    ->setReference("Testing")
    ->setProduct("Product 1", 10.30, 1)
    ->create();
```

## Products

### Create product
```$xslt
MalakatPay::make()
    ->product()
    ->create(string|array $title/$arrays, string $code, string $description, $price);
```

### Get products
```$xslt
MalakatPay::make()
    ->product()
    ->getList();
```

## Customer

### Create customer
```$xslt
MalakatPay::make()
    ->customer()
    ->create(string|array $firstName/$arrays, string $lastName = null, string $phoneNumber = null, string $email = null);
```

### Get customers
```$xslt
MalakatPay::make()
    ->customer()
    ->getList();
```

## DirectPay

### DirectPay Payee
```
$response = MalakatPay::make()
    ->directPay()
    ->payee("COLLECTION CODE")
    ->getDirectPays();

```

### DirectPay Payeer
```
$response = MalakatPay::make()
    ->directPay()
    ->payee("COLLECTION CODE")
    ->getTransactions($direct_pay_payer_code);

```

### Check checksum from Redirect/Webhook
```$xslt
MalakatPay::make()->isCheckSumValid($payload); //boolean
```

## Source
[Malakat Pay Docs](https://stg-console-api.malakatpay.com/docs/2.0/collection)

## Todo
- Other Malakat Pay features. Still under development
- Unit Test 
- Alter Readme

## License
Licensed under the [MIT license](http://opensource.org/licenses/MIT)  
