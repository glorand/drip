[![Latest Stable Version](https://poser.pugx.org/glorand/drip-php/v/stable)](https://packagist.org/packages/glorand/drip-php)
[![Build Status](https://travis-ci.com/glorand/drip.svg?branch=master)](https://travis-ci.com/glorand/drip)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat)](LICENSE.md)
[![CodeFactor](https://www.codefactor.io/repository/github/glorand/drip/badge/master)](https://www.codefactor.io/repository/github/glorand/drip/overview/master)
[![StyleCI](https://github.styleci.io/repos/160333136/shield?branch=master)](https://github.styleci.io/repos/160333136)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/glorand/drip/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/glorand/drip/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/glorand/drip/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/glorand/drip/?branch=master)
# Drip PHP
A PHP wrapper for Drip's REST API v2.0 for PHP 7.1+

Author: Gombos Lorand

## Table of contents
 - [Installation](#installation)
 - [Current Features](#current_features)
    - [Instantiation](#instantiation)
    - [Accounts](#accounts)
 - [Changelog](#changelog)
 - [Contributing](#contributing)
 - [License](#license)


## Installation <a name="installation"></a>
```
$ composer require glorand/drip-php
```

```
{
    "require": {
        "glorand/drip-php": "^1.0"
    }
}
```

## Current Features <a name="current_features"></a>

### Instantiation <a name="instantiation"></a>
```php
use Glorand\Drip\Drip;

$drip = new Drip('your-account-id', 'your-api-token', 'user-agent-optional');
```

### Accounts <a name="accounts"></a>
**List all accounts**
```php
$accounts = $drip->accounts()->list();

if($accounts->isSuccess()) {
    foreach($accounts as $acount) {
        //
    }
}
```
**Fetch an account**
```php 
$account = $drip->accounts()->show('acount-id');

if($accounts->isSuccess()) {
    //
}
```

## Changelog <a name="changelog"></a>
Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing <a name="contributing"></a>
Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License <a name="license"></a>
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
