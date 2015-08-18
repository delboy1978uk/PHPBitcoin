<?php
/**
 * User: delboy1978uk
 * Date: 14/08/15
 * Time: 15:56
 */

namespace Del;

use Exception;
use Del\Bitcoin\Api\Blockchain;
use Del\Bitcoin\Api\Control;
use Del\Bitcoin\Api\Generate;
use Del\Bitcoin\Api\Mining;
use Del\Bitcoin\Api\Network;
use Del\Bitcoin\Api\RawTransaction;
use Del\Bitcoin\Api\Utility;
use Del\Bitcoin\Api\Wallet;


class Bitcoin
{
    /** @var array */
    private $config;

    /** @var array */
    private $api;

    public function __construct($config = null)
    {
        is_array($config) ? $this->setConfig($config) : null;
        $this->api = [];
        $this->id = 0;
    }


    /**
     * @return array
     * @throws \Exception
     */
    public function getConfig()
    {
        if(!is_array($this->config))
        {
            throw new Exception('No configuration');
        }
        if(isset($this->config['username']) && isset($this->config['password']))
        {
            return $this->config;
        }
        throw new Exception('Insufficient config data');
    }


    /**
     * @param array $config
     * @return $this
     */
    public function setConfig(array $config)
    {
        $this->config = $config;
        return $this;
    }

    /**
     * @return Blockchain
     */
    public function getBlockchainApi()
    {
        if(!isset($this->api['blockchain'])){
            $this->api['blockchain'] = new Blockchain($this->getConfig());
        }
        return $this->api['blockchain'];
    }

    /**
     * @return Control
     */
    public function getControlApi()
    {
        if(!isset($this->api['control'])){
            $this->api['control'] = new Control($this->getConfig());
        }
        return $this->api['control'];
    }

    /**
     * @return Generate
     */
    public function getGeneratingApi()
    {
        if(!isset($this->api['generate'])){
            $this->api['generate'] = new Generate($this->getConfig());
        }
        return $this->api['generate'];
    }

    /**
     * @return Mining
     */
    public function getMiningApi()
    {
        if(!isset($this->api['mining'])){
            $this->api['mining'] = new Mining($this->getConfig());
        }
        return $this->api['mining'];
    }

    /**
     * @return Network
     */
    public function getNetworkApi()
    {
        if(!isset($this->api['network'])){
            $this->api['network'] = new Network($this->getConfig());
        }
        return $this->api['network'];
    }

    /**
     * @return RawTransaction
     */
    public function getRawTransactionApi()
    {
        if(!isset($this->api['raw_transaction'])){
            $this->api['raw_transaction'] = new RawTransaction($this->getConfig());
        }
        return $this->api['raw_transaction'];
    }

    /**
     * @return Utility
     */
    public function getUtilityApi()
    {
        if(!isset($this->api['utility'])){
            $this->api['utility'] = new Utility($this->getConfig());
        }
        return $this->api['utility'];
    }

    /**
     * @return Wallet
     */
    public function getWalletApi()
    {
        if(!isset($this->api['wallet'])){
            $this->api['wallet'] = new Wallet($this->getConfig());
        }
        return $this->api['wallet'];
    }

}