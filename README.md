<p align="center">
<img src="https://user-images.githubusercontent.com/883989/49755957-17ec0980-fcc2-11e8-9e04-0339714f979b.png">
</p>

<p align="center">

[![Latest Stable Version](https://poser.pugx.org/glorand/drip-php/v/stable)](https://packagist.org/packages/glorand/drip-php)
[![Build Status](https://travis-ci.com/glorand/drip.svg?branch=master)](https://travis-ci.com/glorand/drip)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat)](LICENSE.md)
[![CodeFactor](https://www.codefactor.io/repository/github/glorand/drip/badge/master)](https://www.codefactor.io/repository/github/glorand/drip/overview/master)
[![StyleCI](https://github.styleci.io/repos/160333136/shield?branch=master)](https://github.styleci.io/repos/160333136)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/glorand/drip/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/glorand/drip/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/glorand/drip/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/glorand/drip/?branch=master)

</a>

# Drip PHP
A PHP wrapper for Drip's REST API v2.0 for PHP 7.1+

Author: Gombos Lorand

## Table of contents
 - [Installation](#installation)
 - [Current Features](#current_features)
    - [Instantiation](#instantiation)
    - [Api Response](#apiresponse)
    - [Accounts](#accounts)
    - [Events](#events)
    - [Subscribers](#subscribers)
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

### ApiResponse <a name="apiresponse"></a>

**Methods**
```php
//http status code
public function getStatusCode(): int {}

public function isSuccess(): bool {}

public function getHttpMessage(): string {}

//drip response
public function getContents(): array {}
```

### Accounts <a name="accounts"></a>
**List all accounts**
```php
$accounts = $drip->accounts()->list();

if($accounts->isSuccess()) {
    foreach($accounts->getContents() as $acount) {
        //
    }
}
```
**Fetch an account**
```php 
$account = $drip->accounts()->show('acount-id');

if($account->isSuccess()) {
    // $account->getContents()
}
```

### Events <a name="events"></a>

**Event Model**
```php
$event = new Event();
$event->setEmail('test@email.com')
    ->setAction('Action')
    ->setOccurredAt(new \DateTime('2018-12-01'))
    ->setProperties(['prop_0' => 'val_prop_0'])
    ->addProperty('prop_1', 'val_prop_1')
    ->removeProperty('prop_1');
```

**Record an event**
```php
/** Event Model */
$event = new Event();

/** boolean */
$drip->events()->store($event);
```
**List all custom events actions used in an account**
```php
/** ApiResponse */
$events = $drip->events()->list();
```

### Subscribers <a name="subscribers"></a>

**Subscriber Model**
```php
$subscriber = new Subscriber();
$subscriber->setEmail('test@email.com')
    ->setNewEmail('new@email.com')
    ->addCustomField('custom_f_1', 'val_custom_f_1')
    ->removeCustomField('custom_f_0')
    ->addTag('tag_1', 'val_tag_1')
    ->removeTag('tag_2')
```
    
**Create or update a subscriber**
```php
/** Subscriber Model */
$subscriber = new Subscriber(); 

/** boolean */
$drip->subscribers()->store($subscriber);
```

**List all subscribers**
```php
/** ApiResponse */
$events = $drip->subscribers()->list();
```

## Changelog <a name="changelog"></a>
Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing <a name="contributing"></a>
Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License <a name="license"></a>
The MIT License (MIT). Please see [LICENSE](LICENSE.md) for more information.
