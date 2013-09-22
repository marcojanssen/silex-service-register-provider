<?php
namespace Marcojanssen\Provider;

use Silex\Application;
use stdClass;
use Marcojanssen\Provider\ServiceRegisterProvider;

class ServiceRegisterProverTest extends \PHPUnit_Framework_TestCase
{

    /**
     * test if multiple providers can be registered through configuration
     */
    public function testConfigServiceProviders()
    {
        $app = new Application();

        $app['providers'] = array(
            array(
                'class' => 'Marcojanssen\Provider\ServiceProviderFoo'
            ),
            array(
                'class' => 'Marcojanssen\Provider\ServiceProviderBaz'
            )
        );

        $app->register(new ServiceRegisterProvider);

        $this->assertEquals(new stdClass(), $app['foo']);
        $this->assertEquals(new stdClass(), $app['baz']);
    }

    /**
     * test if multiple providers can be registered
     */
    public function testRegisterServiceProviders()
    {
        $app = new Application();
        $serviceRegisterProvider = new ServiceRegisterProvider();

        $providers = array(
            array(
                'class' => 'Marcojanssen\Provider\ServiceProviderFoo'
            ),
            array(
                'class' => 'Marcojanssen\Provider\ServiceProviderBaz'
            )
        );

        $serviceRegisterProvider->registerServiceProviders($app, $providers);

        $this->assertEquals(new stdClass(), $app['foo']);
        $this->assertEquals(new stdClass(), $app['baz']);
    }

    /**
     * test if a single provider can be registered
     */
    public function testRegisterServiceProvider()
    {
        $app = new Application();
        $serviceRegisterProvider = new ServiceRegisterProvider();

        $provider = array(
            'class' => 'Marcojanssen\Provider\ServiceProviderFoo'
        );

        $serviceRegisterProvider->registerServiceProvider($app, $provider);

        $this->assertEquals(new stdClass(), $app['foo']);
    }

    /**
     * test if a single provider can be registered
     * @expectedException InvalidArgumentException
     */
    public function testClassNameServiceProvider()
    {
        $app = new Application();
        $provider = array();
        $serviceRegisterProvider = new ServiceRegisterProvider();
        $serviceRegisterProvider->registerServiceProvider($app, $provider);
    }
}
