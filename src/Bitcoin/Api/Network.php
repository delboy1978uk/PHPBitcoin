<?php
/**
 * User: delboy1978uk
 * Date: 18/08/15
 * Time: 19:54
 */

namespace Del\Bitcoin\Api;


class Network extends AbstractApi
{

    /**
     * The addnode RPC attempts to add or remove a node from
     * the addnode list, or to try a connection to a node once.
     *
     * @param string $host The node to add as a string in the form of
     * <IP address>:<port>. The IP address may be a hostname
     * resolvable through DNS, an IPv4 address, an IPv4-as-IPv6 address,
     * or an IPv6 address
     * @return mixed
     */
    public function addNode($host)
    {
        return $this->send('addnode',[$host]);
    }

    /**
     * The getaddednodeinfo RPC returns information about the given added
     * node, or all added nodes (except onetry nodes). Only nodes which
     * have been manually added using the addnode RPC will have their
     * information displayed.
     *
     * @param bool $details Set to true to display detailed
     * information about each added node; set to false to only
     * display the IP address or hostname and port added
     * @param string $node The node to get information about in the same
     * <IP address>:<port> format as the addnode RPC. If this parameter
     * is not provided, information about all added nodes will be returned
     * @return mixed
     */
    public function getAddedNodeInfo($details,$node)
    {
        return $this->send('getaddednodeinfo',[$details,$node]);
    }

    /**
     * The getconnectioncount RPC returns the number of connections
     * to other nodes.
     *
     * @return mixed
     */
    public function getConnectionCount()
    {
        return $this->send('getconnectioncount');
    }

    /**
     * The getnettotals RPC returns information about network traffic,
     * including bytes in, bytes out, and the current time.
     *
     * @return mixed
     */
    public function getNetTotals()
    {
        return $this->send('getnettotals');
    }

    /**
     * The getnetworkinfo RPC returns information about the node’s
     * connection to the network.
     *
     * @return mixed
     */
    public function getNetworkInfo()
    {
        return $this->send('getnetworkinfo');
    }


    /**
     * The getpeerinfo RPC returns data about each
     * connected network node.
     *
     * @return mixed
     */
    public function getPeerInfo()
    {
        return $this->send('getpeerinfo');
    }

    /**
     * The ping RPC sends a P2P ping message to all connected nodes
     * to measure ping time. Results are provided by the getpeerinfo
     * RPC pingtime and pingwait fields as decimal seconds. The P2P
     * ping message is handled in a queue with all other commands, so
     * it measures processing backlog, not just network ping.
     *
     * Get the results using the getpeerinfo RPC:
     *
     * @return mixed
     */
    public function ping()
    {
        return $this->send('ping');
    }
}