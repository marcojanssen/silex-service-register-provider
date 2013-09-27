<?php
namespace MJanssen\Provider;

use InvalidArgumentException;
use Silex\Application;
use Silex\ServiceProviderInterface;

/**
 * Class ServiceRegisterProvider
 * @package MJanssen\Provider
 */
class ServiceRegisterProvider implements ServiceProviderInterface
{
    /**
     * @var
     */
    protected $appServiceKey;

    /**
     * @param string $appNode
     */
    public function __construct($appServiceKey = 'config.providers')
    {
        $this->appServiceKey = $appServiceKey;
    }

    /**
     * @param Application $app
     */
    public function register(Application $app)
    {
        if(isset($app[$this->appServiceKey])) {
            $this->registerServiceProviders($app, $app[$this->appServiceKey]);
        }
    }

    /**
     * @param Application $app
     * @codeCoverageIgnore
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
            throw new InvalidArgumentException(
                'The service provider did not specify its "class".'
            );
        }

        if (!isset($provider['values'])) {
            $provider['values'] = array();
        }

        if (!is_array($provider['values'])) {
            throw new InvalidArgumentException(
                'The service provider values should be an array.'
            );
        }

        $app->register(new $provider['class'](), $provider['values']);
    }
}
