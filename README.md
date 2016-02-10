# README

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/d2080982-fddd-4880-a5ec-c7fc9ccf7608/big.png)](https://insight.sensiolabs.com/projects/d2080982-fddd-4880-a5ec-c7fc9ccf7608)

## Installation
To install this bundle, run the command below and you will get the latest version.

``` bash
composer require hob/token-bundle
```

To use the newest (maybe unstable) version please add following into your composer.json:

``` json
{
    "require": {
        "hob/token-bundle": "dev-master"
    }
}
```


## Usage
Load bundle in AppKernel.php:
``` php
new HOB\TokenBundle\HOBTokenBundle()
```

Configuration in config.yml:
``` yaml
token_bundle:
    required: true
```
