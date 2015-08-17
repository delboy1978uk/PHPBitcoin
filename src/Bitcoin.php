<?php
/**
 * User: delboy1978uk
 * Date: 14/08/15
 * Time: 15:56
 */

namespace Del;

use GuzzleHttp\Client;
use Psr\Http\Message;
use Exception;


class Bitcoin
{
    private $config;

    private $client;

    private $host;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param array $config
     * @return bool
     * @throws \Exception
     */
    public function setConfig(array $config)
    {
        $this->config = $config;
        $this->host = $config['protocol'].'://'.$config['host'].':'.$config['port'];
        return $this;
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
        return $this->config;
    }

    /**
     * @return Client
     */
    private function getClient()
    {
        return $this->client;
    }
}