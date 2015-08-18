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

        $this->config = [
            'username' => 'phpbitcoin',
            'password' => 'COMPLETELYrandomPASSWORD',
            'host' => '127.0.0.1',
            'port' => '18332',
            'protocol' => 'http',
            'ssl_certificate' => '',
        ];

        // create a fresh bitcoin class before each test
        $this->btc = new Bitcoin($this->config);
    }

    protected function _after()
    {
        // unset the bitcoin class after each test
        unset($this->btc);
    }

    /**
     * Check config setting works
     */
    public function testGetandSetConfig()
    {
        $this->btc = new Bitcoin();
        $this->btc->setConfig($this->config);
        $this->assertTrue(is_array($this->btc->getConfig()));
    }



    /**
     * Check config setting works
     */
    public function testSetConfigThroughConstructor()
    {
        $this->assertTrue(is_array($this->btc->getConfig()));
    }



    /**
     * Check config setting works
     */
    public function testThrowsExceptionWhenNoConfigFile()
    {
        $this->setExpectedException('Exception');
        $this->btc = new Bitcoin();
        $this->btc->getConfig();
    }



    /**
     * Check config setting works
     */
    public function testThrowsExceptionWhenMissingRequiredConfig()
    {
        $this->setExpectedException('Exception');
        $this->btc = new Bitcoin([]);
        $this->btc->getConfig();
    }



    /**
     * Check call returns correct api class
     */
    public function testGetBlockchainApi()
    {
        $api = $this->btc->getBlockchainApi();
        $this->assertInstanceOf('Del\Bitcoin\Api\Blockchain',$api);
    }



    /**
     * Check call returns correct api class
     */
    public function testGetControlApi()
    {
        $api = $this->btc->getControlApi();
        $this->assertInstanceOf('Del\Bitcoin\Api\Control',$api);
    }



    /**
     * Check call returns correct api class
     */
    public function testGeneratingApi()
    {
        $api = $this->btc->getGeneratingApi();
        $this->assertInstanceOf('Del\Bitcoin\Api\Generate',$api);
    }



    /**
     * Check call returns correct api class
     */
    public function testGetMiningApi()
    {
        $api = $this->btc->getMiningApi();
        $this->assertInstanceOf('Del\Bitcoin\Api\Mining',$api);
    }



    /**
     * Check call returns correct api class
     */
    public function testGetNetworkApi()
    {
        $api = $this->btc->getNetworkApi();
        $this->assertInstanceOf('Del\Bitcoin\Api\Network',$api);
    }



    /**
     * Check call returns correct api class
     */
    public function testGetRawTransactionApi()
    {
        $api = $this->btc->getRawTransactionApi();
        $this->assertInstanceOf('Del\Bitcoin\Api\RawTransaction',$api);
    }



    /**
     * Check call returns correct api class
     */
    public function testGetUtilityApi()
    {
        $api = $this->btc->getUtilityApi();
        $this->assertInstanceOf('Del\Bitcoin\Api\Utility',$api);
    }



    /**
     * Check call returns correct api class
     */
    public function testGetWalletApi()
    {
        $api = $this->btc->getWalletApi();
        $this->assertInstanceOf('Del\Bitcoin\Api\Wallet',$api);
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
