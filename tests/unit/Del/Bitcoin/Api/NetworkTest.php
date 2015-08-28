<?php

namespace Del\Bitcoin\Api;


use GuzzleHttp\Exception\ServerException;

class NetworkTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var Network
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
        $this->api = new Network($this->config);


    }

    protected function _after()
    {
        // unset the api class after each test
        unset($this->api);
    }




    public function testGetConnectionCount()
    {
        $info = json_decode($this->api->getConnectionCount(),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertTrue(is_numeric($info['result']));
    }



    public function testGetNetTotals()
    {
        $info = json_decode($this->api->getNetTotals(),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertArrayHasKey('totalbytesrecv',$info['result']);
    }



    public function testGetNetworkInfo()
    {
        $info = json_decode($this->api->getNetworkInfo(),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertArrayHasKey('version',$info['result']);
    }



    public function testGetPeerInfo()
    {
        $info = json_decode($this->api->getPeerInfo(),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertArrayHasKey('addrlocal',$info['result'][0]);
    }



    public function testPing()
    {
        $info = json_decode($this->api->ping(),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertNull($info['result']);
    }



    public function testAddNode()
    {
        try{
            $info = json_decode($this->api->addNode('blockexplorer.com:18332','add'),true);
            $this->assertArrayHasKey('result',$info);
            $this->assertNull($info['result']);
            $this->assertNull($info['error']);

            $info = json_decode($this->api->addNode('blockexplorer.com:18332','remove'),true);
            $this->assertArrayHasKey('result',$info);
            $this->assertNull($info['result']);
            $this->assertNull($info['error']);
        } catch (ServerException $e) {
            $info = json_decode($e->getResponse()->getBody(),true);
            $this->assertArrayHasKey('result',$info);
            $this->assertNull($info['result']);
            $this->assertArrayHasKey('error',$info);
            $this->assertArrayHasKey('code',$info['error']);
            $this->assertArrayHasKey('message',$info['error']);
            $this->assertEquals($info['error']['code'],-23);
            $this->assertEquals($info['error']['message'],'Error: Node already added');

            $info = json_decode($this->api->addNode('blockexplorer.com:18332','remove'),true);
            $this->assertArrayHasKey('result',$info);
            $this->assertNull($info['result']);
            $this->assertNull($info['error']);
        }

    }



    public function testGetAddedNodeInfo()
    {
        $this->api->addNode('blockexplorer.com:18332','add');
        $info = json_decode($this->api->getAddedNodeInfo(true,'blockexplorer.com:18332'),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertArrayHasKey('addednode',$info['result'][0]);
        $this->api->addNode('blockexplorer.com:18332','remove');
    }
}
