Auspost API Client Library for PHP
==================================

This library is a Guzzle-based client for integrating PHP applications with
Australia Post's web services.

Documentation on how to use this library can be found in the [Postage
Assessment Calculation and Postcode Search][pacpcs-api-specification] and the
[Delivery Choices][dce-api-specification] specifications.

## Table of Contents

* [Getting Started](#getting-started)
  * [Register to use Australia Post services](#register-to-use-australia-post-services)
  * [Minimum requirements](#minimum-requirements)
  * [Install using Composer](#install-using-composer)
  * [Install using Git](#install-using-git)
* [Quick Example](#quick-example)
  * [Calculate domestic parcel postage cost](#calculate-domestic-parcel-postage-cost)
* [Contributions](#contributions)
  * [Guidelines](#guidelines)
  * [Contributors](#contributors)

## Getting Started

### Register to use Australia Post services

You will need to apply for an API key if you want to use the [Postage Assessment
Calculator and Postcode Search][pacpcs-registration] services. Similarly, you
will also need to apply for permission to use the [Delivery Choices]
[dce-registration] service.

### Minimum requirements

1. PHP 5.3.10 compiled with the cURL extension
1. cURL 7.22.0

**Note:** The library is likely to work with earlier versions of PHP and cURL,
but they have not been tested.

### Install using Composer

1. Add `fontis/auspost-api-php` as a Composer dependency in your project's `composer.json` file:
```json
{
    "require": {
        "fontis/auspost-api-php": "*"
    }
}
```

2. Download and install Composer into the repo:
```bash
$ curl -sS https://getcomposer.org/installer | php
```

3. Install the library dependencies:
```bash
$ php composer.phar install
```

4. Add the library to your PHP application:
```php
require_once 'vendor/autoload.php';
```

### Install using Git

1. Clone this repo to an appropriate location:
```bash
$ git clone https://github.com/fontis/auspost-api-php
```

2. Download and install Composer into the repo:
```bash
$ cd auspost-api-php
$ curl -sS https://getcomposer.org/installer | php
```

3. Install the library dependencies:
```bash
$ php composer.phar install
```

4. Add the library to your PHP application:
```php
require_once 'vendor/autoload.php';
```

## Quick Example

### Calculate domestic parcel postage cost

```php
<?php
require 'vendor/autoload.php';

use Auspost\Common\Auspost;
use Auspost\Postage\Enum\ServiceCode;

// Instantiate a Postage Assessment Calculator service
$client = Auspost::factory('/path/to/config.php')->get('postage');

$result = $client->calculateDomesticParcelPostage(array(
    'from_postcode' => 3000,
    'to_postocde' => 3011,
    'length' => 10,
    'width' => 10,
    'height' => 10,
    'weight' => 10,
    'service_code' => ServiceCode::AUS_PARCEL_REGULAR
));
```

## Contributions

This project is open source. You are encouraged to fork and submit pull
requests.

### Guidelines

Please ensure your code adheres to the following guidelines in order for your
pull request to be accepted.

1. **Follow the PHP-FIG standards recommendations** - This library is written
with adherence to the PSR-0, PSR-1 and PSR-2 standard recommendations.
1. **Write unit tests** - Any new functionality should include corresponding
tests.
1. **Add the licence header to new files** - We would appreciate having licence
headers been added to the top of new files.

[pacpcs-api-specification]: http://auspost.com.au/devcentre/assets/pdfs/pac-pcs-technical-specification.pdf
[pacpcs-registration]: https://auspost.com.au/forms/pacpcs-registration.html
[dce-registration]: https://auspost.com.au/forms/dce-registration.html
[dce-api-specification]: http://auspost.com.au/devcentre/assets/pdfs/delivery-choice-technical-specificationsv3-4.pdf
