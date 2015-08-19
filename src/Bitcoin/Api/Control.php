<?php
/**
 * User: delboy1978uk
 * Date: 18/08/15
 * Time: 19:49
 */

namespace Del\Bitcoin\Api;


class Control extends AbstractApi
{
    /**
     * The getinfo RPC prints various information about the node and the network.
     * @return mixed
     */
    public function getInfo()
    {
        return $this->send('getinfo');
    }

    /**
     * The help RPC lists all available public RPC commands,
     * or gets help for the specified RPC. Commands which are
     * unavailable will not be listed, such as wallet RPCs if
     * wallet support is disabled.
     * @return mixed
     */
    public function help()
    {
        return $this->send('help');
    }

    /**
     * The stop RPC safely shuts down the Bitcoin Core server.
     * @return mixed
     */
    public function stop()
    {
        return $this->send('stop');
    }
}