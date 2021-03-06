<?php

namespace Del\Bitcoin\Api;

use GuzzleHttp\Exception\ServerException;

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
        $info = json_decode($this->api->listReceivedByAddress(),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertTrue(is_array($info['result']));
        $this->assertNull($info['error']);
    }





    public function testListAddressGroupings()
    {
        $info = json_decode($this->api->listAddressGroupings(),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertTrue(is_array($info['result']));
        $this->assertNull($info['error']);
    }





    public function testDumpWallet()
    {
        $file = __DIR__.DIRECTORY_SEPARATOR.'wallet.backup';
        $info = json_decode($this->api->dumpWallet($file),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertNull($info['result']);
        $this->assertNull($info['error']);
        $this->assertTrue(file_exists($file));
        unlink($file);
    }





    public function testBackupWallet()
    {
        $file = __DIR__.DIRECTORY_SEPARATOR.'wallet.dat';
        $info = json_decode($this->api->backupWallet(__DIR__),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertNull($info['result']);
        $this->assertNull($info['error']);
        $this->assertTrue(file_exists($file));
        unlink($file);
    }



    public function testImportWallet()
    {
        $file = __DIR__.DIRECTORY_SEPARATOR.'wallet.dat';
        $this->api->backupWallet(__DIR__);
        $info = json_decode($this->api->importWallet($file),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertArrayHasKey('error',$info);
        $this->assertNull($info['result']);
        $this->assertNull($info['error']);
        unlink($file);
    }





    public function testListLockUnspent()
    {
        $info = json_decode($this->api->listLockUnspent(),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertTrue(is_array($info['result']));
        $this->assertNull($info['error']);
    }





    public function testKeyPoolRefill()
    {
        $info = json_decode($this->api->keyPoolRefill(1),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertArrayHasKey('error',$info);
        $this->assertNull($info['result']);
        $this->assertNull($info['error']);
    }



    public function testAddMultiSigAddress()
    {
        $util = new Utility($this->config);
        $add = json_decode($this->api->getNewAddress(),true)['result'];
        $add2 = json_decode($this->api->getNewAddress(),true)['result'];
        $pub1 = json_decode($util->validateAddress($add),true)['result']['pubkey'];
        $pub2 = json_decode($util->validateAddress($add2),true)['result']['pubkey'];
        $info = json_decode($this->api->addMultiSigAddress(2,[$pub1,$pub2]),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertArrayHasKey('error',$info);
        $this->assertTrue(is_string($info['result']));
        $this->assertNull($info['error']);
    }





    public function testSetAccount()
    {
        $add = json_decode($this->api->getNewAddress(),true)['result'];
        $info = json_decode($this->api->setAccount($add,'delboy1978uk'),true);
        $this->assertArrayHasKey('result',$info);
        $this->assertArrayHasKey('error',$info);
        $this->assertNull($info['result']);
        $this->assertNull($info['error']);
    }





    public function testSendToAddress()
    {
        try {
            $this->api->sendToAddress('mpXwg4jMtRhuSpVq4xS3HFHmCmWp9NyGKt',1.0,'this will fail, we aint got the funds');
        } catch (ServerException $e) {
            $info = json_decode($e->getResponse()->getBody(),true);
            $this->assertArrayHasKey('result',$info);
            $this->assertNull($info['result']);
            $this->assertArrayHasKey('error',$info);
            $this->assertArrayHasKey('code',$info['error']);
            $this->assertArrayHasKey('message',$info['error']);
            $this->assertTrue($info['error']['code'] == -6);
            $this->assertTrue($info['error']['message'] == 'Insufficient funds');
        }
    }





    public function testSendMany()
    {
        try {
            $add1 = json_decode($this->api->getNewAddress(),true)['result'];
            $add2 = json_decode($this->api->getNewAddress(),true)['result'];
            $this->api->sendMany('',
                [
                    $add1 => 100,
                    $add2 => 100,
                ]
                ,1,'this will fail, we aint got the funds'
            );
        } catch (ServerException $e) {
            $info = json_decode($e->getResponse()->getBody(),true);
            $this->assertArrayHasKey('result',$info);
            $this->assertNull($info['result']);
            $this->assertArrayHasKey('error',$info);
            $this->assertArrayHasKey('code',$info['error']);
            $this->assertArrayHasKey('message',$info['error']);
            $this->assertTrue($info['error']['code'] == -6);
            $this->assertTrue($info['error']['message'] == 'Account has insufficient funds');
        }
    }





    public function testSendFrom()
    {
        try {
            $this->api->sendFrom('','mpXwg4jMtRhuSpVq4xS3HFHmCmWp9NyGKt',100,1,'this will fail, we aint got the funds');
        } catch (ServerException $e) {
            $info = json_decode($e->getResponse()->getBody(),true);
            $this->assertArrayHasKey('result',$info);
            $this->assertNull($info['result']);
            $this->assertArrayHasKey('error',$info);
            $this->assertArrayHasKey('code',$info['error']);
            $this->assertArrayHasKey('message',$info['error']);
            $this->assertTrue($info['error']['code'] == -6);
            $this->assertTrue($info['error']['message'] == 'Account has insufficient funds');
        }
    }


}
