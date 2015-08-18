<?php

namespace Del\Bitcoin\Api;

use ReflectionClass;

class ControlTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var Control
     */
    protected $api;

    /**
     * @var array
     */
    protected $config;

    protected function _before()
    {

        $this->config = [
            'username' => 'phpbitcoin',
            'password' => 'COMPLETELYrandomPASSWORD',
            'host' => '127.0.0.1',
            'port' => '18332',
            'protocol' => 'http',
            'ssl_certificate' => '',
        ];

        // create a fresh Control API class before each test
        $this->api = new Control($this->config);
    }

    protected function _after()
    {
        // unset the api class after each test
        unset($this->api);
    }



    /**
     * Check config setting works
     */
    public function testGetClient()
    {
        $client = $this->invokeMethod($this->api,'getClient');
        $this->assertInstanceOf('GuzzleHttp\Client',$client);
    }



    public function testGetInfo()
    {
        $info = json_decode($this->api->getInfo(),true);
        $this->assertArrayHasKey('connections',$info['result']);
    }




    /**
     * This method allows us to test protected and private methods without
     * having to go through everything using public methods
     *
     * @param object &$object
     * @param string $methodName
     * @param array  $parameters
     *
     * @return mixed could return anything!.
     */
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $parameters);
    }



}
