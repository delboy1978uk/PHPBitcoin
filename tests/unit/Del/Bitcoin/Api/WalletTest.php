<?php

namespace Del\Bitcoin\Api;


class WalletTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var Wallet
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

        // create a fresh API class before each test
        $this->api = new Wallet($this->config);
    }

    protected function _after()
    {
        // unset the api class after each test
        unset($this->api);
    }




    public function testGetWalletInfo()
    {
        $info = json_decode($this->api->getWalletInfo(),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertArrayHasKey('balance',$info['result']);
    }




    public function testGetRawChangeAddress()
    {
        $info = json_decode($this->api->getRawChangeAddress(),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertTrue(is_string($info['result']));
    }




    public function testGetUnconfirmedBalance()
    {
        $info = json_decode($this->api->getUnconfirmedBalance(),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertTrue(is_float($info['result']));
    }




    public function testGetBalance()
    {
        $info = json_decode($this->api->getBalance(),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertTrue(is_float($info['result']));
    }




    public function testNewAddress()
    {
        $info = json_decode($this->api->getNewAddress(),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertTrue(is_string($info['result']));
    }




    public function testDumpPrivKey()
    {
        $address = json_decode($this->api->getNewAddress(),true)['result'];
        $info = json_decode($this->api->dumpPrivKey($address),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertTrue(is_string($info['result']));
    }




    public function testGetAccountAddress()
    {
        $info = json_decode($this->api->getAccountAddress(),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertTrue(is_string($info['result']));
    }




    public function testListAccounts()
    {
        $info = json_decode($this->api->listAccounts(),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertTrue(is_numeric($info['result']['']));
    }




    public function testGetAddressesByAccount()
    {
        $info = json_decode($this->api->getAddressesByAccount(),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertTrue(is_string($info['result'][0]));
    }




    public function testGetReceivedByAccount()
    {
        $info = json_decode($this->api->getReceivedByAccount(''),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertTrue(is_numeric($info['result']));
        $this->assertNull($info['error']);
    }





}
