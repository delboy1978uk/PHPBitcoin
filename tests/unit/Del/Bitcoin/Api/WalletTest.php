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




    public function testGetNewAddress()
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




    public function testGetAccount()
    {
        $address = json_decode($this->api->getNewAddress(),true)['result'];
        $info = json_decode($this->api->getAccount($address),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertTrue(is_string($info['result']));
        $this->assertNull($info['error']);
    }




    public function testGetReceivedByAddress()
    {
        $address = json_decode($this->api->getNewAddress(),true)['result'];
        $info = json_decode($this->api->getReceivedByAddress($address),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertTrue(is_numeric($info['result']));
        $this->assertNull($info['error']);
    }




    public function testListUnspent()
    {
        $add = json_decode($this->api->getNewAddress(),true)['result'];
        $info = json_decode($this->api->listUnspent(1,9999999,[$add]),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertTrue(is_array($info['result']));
        $this->assertNull($info['error']);
    }




    public function testSetTxFee()
    {
        $info = json_decode($this->api->setTxFee(0.0001),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertTrue($info['result']);
        $this->assertNull($info['error']);
    }





    public function testSignMessage()
    {
        $msg = 'Please consider donating to 1De1boyXJzdk4TYmHkR3st6dJmHuEaneHB';
        $add = json_decode($this->api->getNewAddress(),true)['result'];
        $info = json_decode($this->api->signMessage($add,$msg),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertTrue(is_string($info['result']));
        $this->assertNull($info['error']);
    }





    public function testListTransactions()
    {
        $info = json_decode($this->api->listTransactions(),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertTrue(is_array($info['result']));
        $this->assertNull($info['error']);
    }





    public function testListSinceBlock()
    {
        $info = json_decode($this->api->listSinceBlock(),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertArrayHasKey('transactions',$info['result']);
        $this->assertNull($info['error']);
    }





    public function testListReceivedByAccount()
    {
        $info = json_decode($this->api->listReceivedByAccount(),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertTrue(is_array($info['result']));
        $this->assertNull($info['error']);
    }





    public function testListReceivedByAddress()
    {
        $info = json_decode($this->api->listReceivedByAccount(),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertTrue(is_array($info['result']));
        $this->assertNull($info['error']);
    }




}
