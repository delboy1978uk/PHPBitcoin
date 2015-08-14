<?php

namespace Del;

use ReflectionClass;
use GuzzleHttp\Client;

class BitcoinTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var Bitcoin
     */
    protected $btc;

    /**
     * @var array
     */
    protected $config;

    protected function _before()
    {
        // create a fresh bitcoin class before each test
        $this->btc = new Bitcoin();

        $this->config = [
            'username' => 'testuser',
            'passsword' => '******',
            'host' => 'localhost',
            'port' => '8332',
            'protocol' => 'http',
            'uri' => '',
            'ssl_certificate' => '',
        ];
    }

    protected function _after()
    {
        // unset the bitcoin class after each test
        unset($this->calc);
    }



    /**
     * Check config setting works
     */
    public function testGetClient()
    {
        $client = $this->invokeMethod($this->btc,'getClient');
        $this->assertInstanceOf('GuzzleHttp\Client',$client);
    }

    /**
     * Check config setting works
     */
    public function testGetandSetConfig()
    {
        $this->btc->setConfig($this->config);
        $this->assertTrue(is_array($this->btc->getConfig()));
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
