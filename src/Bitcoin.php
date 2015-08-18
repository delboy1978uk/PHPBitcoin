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
        if($this->config['username'] && $this->config['password'])
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
        if(!$this->api['blockchain']){
            $this->api['blockchain'] = new Blockchain($this->config);
        }
        return $this->api['blockchain'];
    }

    /**
     * @return Control
     */
    public function getControlApi()
    {
        if(!$this->api['control']){
            $this->api['control'] = new Control($this->config);
        }
        return $this->api['control'];
    }

    /**
     * @return Generate
     */
    public function getGeneratingApi()
    {
        if(!$this->api['generate']){
            $this->api['generate'] = new Generate($this->config);
        }
        return $this->api['generate'];
    }

    /**
     * @return Mining
     */
    public function getMiningApi()
    {
        if(!$this->api['mining']){
            $this->api['mining'] = new Mining($this->config);
        }
        return $this->api['mining'];
    }

    /**
     * @return Network
     */
    public function getNetworkApi()
    {
        if(!$this->api['network']){
            $this->api['network'] = new Network($this->config);
        }
        return $this->api['network'];
    }

    /**
     * @return RawTransaction
     */
    public function getRawTransactionApi()
    {
        if(!$this->api['raw_transaction']){
            $this->api['raw_transaction'] = new RawTransaction($this->config);
        }
        return $this->api['raw_transaction'];
    }

    /**
     * @return Utility
     */
    public function getUtilityApi()
    {
        if(!$this->api['utility']){
            $this->api['utility'] = new Utility($this->config);
        }
        return $this->api['utility'];
    }

    /**
     * @return Wallet
     */
    public function getWalletApi()
    {
        if(!$this->api['wallet']){
            $this->api['wallet'] = new Wallet($this->config);
        }
        return $this->api['wallet'];
    }

}