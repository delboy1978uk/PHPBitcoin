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
    /** @var array */
    private $config;

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
        $protocol = isset($config['protocol']) ? $config['protocol'] : 'http';
        $host = isset($config['host']) ? $config['host'] : '127.0.0.1';
        $port = isset($config['port']) ? $config['port'] : '8332';
        $this->config = $config;
        $this->host = $protocol . '://' . $host . ':' . $port;
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