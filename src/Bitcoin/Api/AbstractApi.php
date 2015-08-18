<?php
/**
 * User: delboy1978uk
 * Date: 18/08/15
 * Time: 20:16
 */

namespace Del\Bitcoin\Api;

use GuzzleHttp\Client;

class AbstractApi
{
    /** @var Client */
    private  $client;

    /** @var string */
    private $host;

    public function __construct(array $config)
    {
        $this->setConfig($config);
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
        $this->client = new Client(['base_uri' => $this->host]);
        return $this;
    }

    /**
     * @return Client
     */
    private function getClient()
    {
        return $this->client;
    }

    /**
     * @param $uri
     * @param array $params
     * @return mixed
     */
    protected function send($uri, $params = [])
    {
        $response = $this->getClient()->post('/',[
            'auth' => [
                $this->config['username'],
                $this->config['password'],
            ],
            'headers' => [
                'Accept'     => 'application/json',
                'Content-Type' => 'application/json-rpc',
                'WWW-Authenticate' => 'Basic realm="jsonrpc"'
            ],
            'json' => [
                'method' => $uri,
                'params' => $params,
                'id' => 'phpbitcoin',
            ],
        ]);
        return $response->getBody();
    }
}