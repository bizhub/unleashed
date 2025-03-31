# Unleashed api wrapper

[![Latest Version on Packagist](https://img.shields.io/packagist/v/bizhub/unleashed.svg?style=flat-square)](https://packagist.org/packages/bizhub/unleashed)

https://apidocs.unleashedsoftware.com

## Install

``` bash
composer require bizhub/unleashed
```

Set .env api authentication
```
UNLEASHED_API_ID=
UNLEASHED_API_KEY=
UNLEASHED_PARTNER_NAME=
```

## Usage
```php
\Bizhub\Unleashed\Products::get();
\Bizhub\Unleashed\Products::find($quid);

\Bizhub\Unleashed\ProductGroups::get();

\Bizhub\Unleashed\BillOfMaterials::get();
\Bizhub\Unleashed\BillOfMaterials::find($quid);

\Bizhub\Unleashed\SalesOrders::get();
\Bizhub\Unleashed\SalesOrders::find($quid);

\Bizhub\Unleashed\StockAdjustments::get();
\Bizhub\Unleashed\StockAdjustments::find($quid);
\Bizhub\Unleashed\StockAdjustments::create($quid, [...]);

\Bizhub\Unleashed\StockOnHand::get();
\Bizhub\Unleashed\StockOnHand::find($quid);

\Bizhub\Unleashed\Warehouses::get();
```

## Running Tests

To run tests, run the following command

```bash
  ./vendor/bin/phpunit
```