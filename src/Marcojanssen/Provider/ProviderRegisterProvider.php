<?php
namespace Marcojanssen\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;

/**
 * Class ProviderRegisterProvider
 * @package Marcojanssen\Provider
 */
class ProviderRegisterProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        if(isset($app['providers'])) {
            //do stuff
        }
    }

    public function boot(Application $app)
    {
    }
}
