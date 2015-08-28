<?php

namespace Del\Bitcoin\Api;

use GuzzleHttp\Exception\ServerException;

class MiningTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var Mining
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
        $this->api = new Mining($this->config);


    }

    protected function _after()
    {
        // unset the api class after each test
        unset($this->api);
    }



    public function testGetMiningInfo()
    {
        $info = json_decode($this->api->getMiningInfo(),true);
        $this->assertArrayHasKey('blocks',$info['result']);
    }



    public function testGetBlockTemplate()
    {
        try {
            $info = json_decode($this->api->getBlockTemplate(),true);
            $this->assertArrayHasKey('capabilities',$info['result']);
        } catch (ServerException $e) {
            $info = json_decode($e->getResponse()->getBody(),true);
            $this->assertArrayHasKey('result',$info);
            $this->assertNull($info['result']);
            $this->assertArrayHasKey('error',$info);
            $this->assertArrayHasKey('code',$info['error']);
            $this->assertArrayHasKey('message',$info['error']);
            $this->assertTrue($info['error']['code'] == -10);
            $this->assertTrue($info['error']['message'] == 'Bitcoin is downloading blocks...');
        }
    }


    public function testGetNetworkHashPS()
    {
        $info = json_decode($this->api->getNetworkHashPS(10,1),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertArrayHasKey('error',$info);
        $this->assertTrue(is_numeric($info['result']));
        $this->assertNull($info['error']);
    }


    public function testSubmitBlock()
    {
        try {
            $this->api->submitBlock('This is not a block');
        } catch (ServerException $e) {
            $info = json_decode($e->getResponse()->getBody(),true);
            $this->assertArrayHasKey('result',$info);
            $this->assertNull($info['result']);
            $this->assertArrayHasKey('error',$info);
            $this->assertArrayHasKey('code',$info['error']);
            $this->assertArrayHasKey('message',$info['error']);
            $this->assertTrue($info['error']['code'] == -22);
            $this->assertTrue($info['error']['message'] == 'Block decode failed');
        }
    }

}
