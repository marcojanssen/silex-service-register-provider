<?php
namespace Marcojanssen\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;

/**
 * Class ServiceRegisterProvider
 * @package Marcojanssen\Provider
 */
class ServiceRegisterProvider implements ServiceProviderInterface
{
    /**
     * @param Application $app
     */
    public function register(Application $app)
    {
        if(isset($app['providers'])) {
            $this->registerServiceProviders($app, $app['providers']);
        }
    }

    /**
     * @param Application $app
     */
    public function boot(Application $app)
    {
    }

    /**
     * @param Application $app
     * @param $providers
     */
    public function registerServiceProviders(Application $app, $providers)
    {
        foreach ($providers as $provider) {
            $this->registerServiceProvider($app, $provider);
        }
    }

    /**
     * @param Application $app
     * @param $provider
     * @throws
     */
    public function registerServiceProvider(Application $app, $provider)
    {
        if (!isset($provider['class'])) {
            throw InvalidArgumentException::format(
                'The service provider did not specify its "class".'
            );
        }

        if (!isset($provider['values'])) {
            $provider['values'] = array();
        }

        $app->register(new $provider['class'](), $provider['values']);
    }
}
