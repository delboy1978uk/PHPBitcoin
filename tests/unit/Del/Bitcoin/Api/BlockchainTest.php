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




    public function testGetBlockHash()
    {
        $info = json_decode($this->api->getBlockHash(0),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertTrue(is_string($info['result']));
    }



    public function testGetBlockchainInfo()
    {
        $info = json_decode($this->api->getBlockChainInfo(),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertEquals('test',$info['result']['chain']);
    }




    public function testGetBlockCount()
    {
        $info = json_decode($this->api->getBlockCount(),true);
        $this->assertArrayHasKey('result',$info);
    }




    public function testGetChainTips()
    {
        $info = json_decode($this->api->getChainTips(),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertArrayHasKey('height',$info['result'][0]);
        $this->assertTrue(is_int($info['result'][0]['height']));
    }




    public function testGetDifficulty()
    {
        $info = json_decode($this->api->getDifficulty(),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertTrue(is_numeric($info['result']));
    }




    public function testGetMemPoolInfo()
    {
        $info = json_decode($this->api->getMemPoolInfo(),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertArrayHasKey('size',$info['result']);
        $this->assertTrue(is_numeric($info['result']['size']));
    }




    public function testGetRawMemPool()
    {
        $info = json_decode($this->api->getRawMemPool(true),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertTrue(is_array($info['result']));
    }




    public function testGetTxOutSetInfo()
    {
        $info = json_decode($this->api->getTxOutSetInfo(),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertArrayHasKey('txouts',$info['result']);
        $this->assertTrue(is_numeric($info['result']['txouts']));
    }




    public function testVerifyChain()
    {
        $info = json_decode($this->api->verifyChain(0,1),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertArrayHasKey('error',$info);
        $this->assertTrue($info['result']);
        $this->assertNull($info['error']);
    }




    public function testGetBlock()
    {
        $info = json_decode($this->api->getBlock('000000000933ea01ad0ee984209779baaec3ced90fa3f408719526f8d77f4943'),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertArrayHasKey('confirmations',$info['result']);
        $this->assertNull($info['error']);
    }





}
