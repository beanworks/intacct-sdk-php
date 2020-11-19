# Sage Intacct SDK for PHP

[![Build Status](https://travis-ci.org/Intacct/intacct-sdk-php.svg?branch=master)](https://travis-ci.org/Intacct/intacct-sdk-php)

If you would like to get involved please fork the repository and submit a pull request.

## Resources

* [Sage Intacct][intacct] - Sage Intacct's home page
* [Issues][sdk-issues] - Report issues with the SDK or submit pull requests
* [License][sdk-license] - Apache 2.0 license

## System Requirements

* You must have an active Sage Intacct Web Services Developer license
* PHP >= 5.6
* A recent version of cURL >= 7.19.4 compiled with OpenSSL and zlib
* Composer latest version

## Getting Started
    
Coming soon will be a Getting Started guide.  Coding examples are available at [intacct-sdk-php-examples](https://github.com/Intacct/intacct-sdk-php-examples).

In the meantime, look at the Quick Installation Guide and Example below to help you get started using the SDK.

## Quick Installation Guide

1. Install [Composer][composer]
2. In your code, specify the Sage Intacct SDK for PHP as a dependency in your project's composer.json file:
    
    ```json
    {
        "require": {
            "intacct/intacct-sdk-php": "v1.*"
        }
    }
    ```
    
3. After installing, you need to require Composer's autoloader in your project file(s):
    
    ```php
    require __DIR__ . '/vendor/autoload.php';
    ```

## Quick Example

### Create an Intacct Client

```php
<?php

$loader = require __DIR__ . '/vendor/autoload.php';

use BWIntacct\IntacctClient;

try {
    $client = new IntacctClient($login_array);
} catch (Exception $ex) {
    echo $ex->getMessage();
}
```
    
With the IntacctClient, you can execute any FunctionInterface within a Content object.  See [GettingStarted.php](https://github.com/Intacct/intacct-sdk-php-examples/blob/master/GettingStarted.php) for a complete example.

[intacct]: http://www.intacct.com
[sdk-issues]: https://github.com/Intacct/intacct-sdk-php/issues
[sdk-license]: http://www.apache.org/licenses/LICENSE-2.0
[composer]: https://getcomposer.org/
[packagist]: https://packagist.org/packages/intacct/intacct-sdk-php
