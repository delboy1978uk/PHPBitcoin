<?php

namespace Del\Bitcoin\Api;

class UtilityTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var Utility
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
        $this->api = new Utility($this->config);


    }

    protected function _after()
    {
        // unset the api class after each test
        unset($this->api);
    }



    public function testCreateMultisig()
    {
        $wallet = new Wallet($this->config);
        $add = json_decode($wallet->getNewAddress(''),true)['result'];
        $info = json_decode($this->api->createMultiSig(1,[$add]),true);
        $this->assertArrayHasKey('redeemScript',$info['result']);
    }



    public function testValidateAddress()
    {
        $info = json_decode($this->api->validateAddress('mpXwg4jMtRhuSpVq4xS3HFHmCmWp9NyGKt'),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertArrayHasKey('isvalid',$info['result']);
    }


}
