<?php

namespace Del\Bitcoin\Api;

use AspectMock\Test;

class GeneratingTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var Generating
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
        $this->api = new Generating($this->config);


    }

    protected function _after()
    {
        // unset the api class after each test
        unset($this->api);

        Test::clean();
    }




    public function testSetGenerate()
    {
        $info = json_decode($this->api->setGenerate(true,1),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertNull($info['result']);
        $this->assertNull($info['error']);
        $this->api->setGenerate(false,0);
    }




    public function testGetGenerate()
    {
        $info = json_decode($this->api->getGenerate(),true);
        $this->assertFalse($info['result']);
    }


    /**
     *  this doesnt run on the testnet so we'll mock the return
     */
    public function testGenerate()
    {
        Test::double('Del\Bitcoin\Api\AbstractApi',['send' => null]);
        $info = json_decode($this->api->generate(1),true);
        $this->assertNull($info);
    }


}
