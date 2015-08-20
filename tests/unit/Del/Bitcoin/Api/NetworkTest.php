<?php

namespace Del\Bitcoin\Api;


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
        //add a non existant ip address
        $info = json_decode($this->api->addNode('192.168.144.144','add'),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertNull($info['result']);
        $this->assertNull($info['error']);

        // remove the node
        $info = json_decode($this->api->addNode('192.168.144.144','remove'),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertNull($info['result']);
        $this->assertNull($info['error']);
    }



}
