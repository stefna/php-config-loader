# Config

[![Build Status](https://github.com/stefna/php-config-loader/actions/workflows/continuous-integration.yml/badge.svg?branch=main)](https://github.com/stefna/php-config-loader/actions/workflows/continuous-integration.yml)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/stefna/config.svg)](https://packagist.org/packages/stefna/config)
[![Software License](https://img.shields.io/github/license/stefna/php-config-loader.svg)](LICENSE)

This package is a lightweight config loader with type safety as the primary
corner stone.

## Requirements

PHP 8.2 or higher.

## Installation

```bash
composer require stefna/config
```

## Motivation

Most config loaders fail to give the user a way to use it in a type safe 
way. 

It also promises to be immutable after first read.

## Usage

### Load config from file

We support writing your config in php files

Example: 
```php
<?php

// config.php

return [
	'config-key' => 'value',
	'nested' => [
		'key' => 'nested-value'
		'bool-key' => false,
	],
];
```

```php
$config = new \Stefna\Config\FileConfig('path-to-php/config.php');
// config file is not read until it's needed

$config->getBool('nested.bool-key') === false;
$config->getString('config-key') === 'value';
```

### Load multiple files into config

```php
<?php

// common.php

return [
	'config-key' => 'value',
	'nested' => [
		'key' => 'nested-value'
		'bool-key' => false,
	],
];
```
```php
<?php

// production.php

return [
	'config-key' => 'production-value',
	'nested' => [
		'extra-key' => 42,
	],
];
```

```php
$config = new \Stefna\Config\FileCollectionConfig('path-to-php/');
$config->addFile('common.php');
$config->addFile('production.php');

// config files is not read until it's needed

$config->getInt('nested.extra-key') === 42;
$config->getString('config-key') === 'product-value';
```

### Mutable config

We do provide a mutable config that allows you to override values in the "root" config
this is meant to be used when testing applications but still allow the "root" configuration to stay immutable


```php
$rootConfig = new \Stefna\Config\FileCollectionConfig('path-to-php/');
$rootConfig->addFile('common.php');
$rootConfig->addFile('production.php');

$config = new \Stefna\Config\MutableConfig($rootConfig);

$config->setConfigValue('config-key', 'overridden-value');

$config->getString('config-key') === 'overridden-value';

$config->resetConfigValue('config-key');

$config->getString('config-key') === 'production-value';
```


## Contribute

We are always happy to receive bug/security reports and bug/security fixes

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

