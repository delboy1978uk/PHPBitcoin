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

    private $auth_digest;

    private $id;

    public function __construct($config = null)
    {
        if($config)
        {
            $this->setConfig($config);
        }
        $this->id = 0;
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
        $this->auth_digest = base64_encode($config['username'].':'.$config['password']);
        $this->client = new Client(['base_uri' => $this->host]);
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

    /**
     * Bitcoin's hello world
     * @return string
     */
    public function getInfo()
    {
        return $this->send('getinfo');
    }

    /**
     * @param $uri
     * @param array $params
     * @return mixed
     */
    private function send($uri, $params = [])
    {
        $this->id ++ ;
        $response = $this->getClient()->post('/',[
            'auth' => [
                $this->getConfig()['username'],
                $this->getConfig()['password'],
            ],
            'headers' => [
                'Accept'     => 'application/json',
                'Content-Type' => 'application/json-rpc',
                'WWW-Authenticate' => 'Basic realm="jsonrpc"'
            ],
            'json' => [
                'method' => $uri,
                'params' => $params,
                'id' => $this->id,
            ],
        ]);
        return $response->getBody();
    }
}