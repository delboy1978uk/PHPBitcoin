<?php

namespace Del\Bitcoin\Api;


class BlockchainTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var Blockchain
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
        $this->api = new Blockchain($this->config);
    }

    protected function _after()
    {
        // unset the api class after each test
        unset($this->api);
    }




    public function testGetBestBlockHash()
    {
        $info = json_decode($this->api->getBestBlockHash(),true);
        $this->assertArrayHasKey('result',$info);
    }




}
