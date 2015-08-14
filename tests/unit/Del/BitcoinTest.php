<?php

namespace Del;

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

    protected function _before()
    {
        // create a fresh bitcoin class before each test
        $this->btc = new Bitcoin();
    }

    protected function _after()
    {
        // unset the bitcoin class after each test
        unset($this->calc);
    }

    /**
     * Check tests are working
     */
    public function testBlah()
    {
	    $this->assertEquals('Ready to start building tests',$this->btc->blah());
    }


}
