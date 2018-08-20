Kohana Storage
=============

**NOT 100% TESTED YET / NOT FOR PRODUCTION**

A Kohana module for using the Flysystem package to abstract storage
http://flysystem.thephpleague.com/docs/

1. [Installation](#installation)
2. [Configuration](#configuration)
3. [Usage](#usage)

## Installation

Go to your main folder and use composer to install Flysystem

`composer require league/flysystem` ~1.0, ships with local (default) and /dev/null

Then install some adapters that you intend to use

* AWS S3 `composer require league/flysystem-aws-s3-v3`
  * For performance, install the cached adapter `composer require league/flysystem-cached-adapter`
* Azure `composer require league/flysystem-azure-blob-storage`
* DigitalOcean Spaces `composer require league/flysystem-aws-s3-v3` (same as S3)
* Memory `composer require league/flysystem-memory`
* SFTP `composer require league/flysystem-sftp`

Download package in modules folder `modules/kohana-storage`

Enable in the module

```
Kohana::modules([
    ...
    'storage' => 'modules/kohana-storage',
    ...
]);
```

## Configuration

Copy `config/storage.php` to `application/config/storage.php`

## Usage

Use the default disk

* `Storage::instance()->put('file.txt', 'Contents');`
* In production, this should point to your main filesystem like s3

Use the local disk (for quick saves to local)

* `Storage::local()->put('file.txt', 'Contents');`
* Need to make sure 'local' is configured like in the default config file

Specify a disk to use

* `Storage::instance('local')->put('file.txt', 'Contents');`
* `Storage::instance('s3')->put('file.txt', 'Contents');`

Flysystem API documentation

https://flysystem.thephpleague.com/docs/usage/filesystem-api/

## TODO

* <del>Add support for Cache</del> https://flysystem.thephpleague.com/docs/advanced/caching/
* Add support for MountManager http://flysystem.thephpleague.com/docs/advanced/mount-manager/
* Add support for Performance https://flysystem.thephpleague.com/docs/advanced/performance/
