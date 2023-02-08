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

```php

$config = new \Stefna\Config\FileConfig('path-to-php-config.php');
// config file is not read until it's needed

$config->getBool('boolKey');
```

## Contribute

We are always happy to receive bug/security reports and bug/security fixes

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

