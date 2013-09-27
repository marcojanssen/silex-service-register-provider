# ServiceRegisterProvider #

-----

[![Build Status](https://api.travis-ci.org/marcojanssen/silex-service-register-provider.png?branch=master)](https://travis-ci.org/marcojanssen/silex-service-register-provider)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/marcojanssen/silex-service-register-provider/badges/quality-score.png?s=021de4c78b24e9d4fb68104dfe93d0b7b95da0e8)](https://scrutinizer-ci.com/g/marcojanssen/silex-service-register-provider/)
[![Code Coverage](https://scrutinizer-ci.com/g/marcojanssen/silex-service-register-provider/badges/coverage.png?s=ad56aacb053227adba93d665bd5b3ca1bea226b1)](https://scrutinizer-ci.com/g/marcojanssen/silex-service-register-provider/)

**ServiceRegisterProvider** is a provider for registering other providers.

## Features ##

- Register providers through configuration
- Register multiple providers with the provider
- Register a single provider with the provider

## Installing

- Install [Composer](http://getcomposer.org)

- Add `marcojanssen/silex-service-register-provider` to your `composer.json`:

```json
{
    "require": {
        "marcojanssen/silex-service-register-provider": "1.*"
    }
}
```

- Install/update your dependencies

## Usage

### Registering a single provider

`index.php`
```php

use Silex\Application;
use MJanssen\Provider\ServiceRegisterProvider;

$app = new Application();

$provider = array(
    'class' => 'MJanssen\Provider\ServiceProviderFoo',
    'values' => array(
        'foo' => 'baz'
    )
);

$serviceRegisterProvider = new ServiceRegisterProvider();
$serviceRegisterProvider->registerServiceProvider($app, $provider);

```

### Registering multiple providers

`index.php`
```php

use Silex\Application;
use MJanssen\Provider\ServiceRegisterProvider;

$app = new Application();
$serviceRegisterProvider = new ServiceRegisterProvider();

$providers = array(
    array(
        'class' => 'MJanssen\Provider\ServiceProviderFoo'
    ),
    array(
        'class' => 'MJanssen\Provider\ServiceProviderBaz'
    )
);

$serviceRegisterProvider->registerServiceProviders($app, $providers);

```

### Registering providers with configuration

For this example the [ConfigServiceProvider](https://github.com/igorw/ConfigServiceProvider) is used to read the yml file. The ServiceRegisterProvider picks the stored configuration through the node `providers` in `$app['providers']`

`services.yml`

```yml

providers:
  validator:
    class: Silex\Provider\ValidatorServiceProvider

  controller.service:
    class: Silex\Provider\ServiceControllerServiceProvider

```

`index.php`
```php

use Silex\Application;
use Igorw\Silex\ConfigServiceProvider;
use MJanssen\Provider\ServiceRegisterProvider;

//Set all service providers
$app->register(
    new ConfigServiceProvider(__DIR__."/../app/config/services.yml")
);

//Register all providers
$app->register(
    new ServiceRegisterProvider()
);

```