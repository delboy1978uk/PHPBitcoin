<?php
/**
 * User: delboy1978uk
 * Date: 18/08/15
 * Time: 19:52
 */

namespace Del\Bitcoin\Api;


class Mining extends AbstractApi
{

    /**
     * The getblocktemplate RPC gets a block template or proposal for use
     * with mining software. For more information, please see the following
     * resources:
     * Bitcoin Wiki GetBlockTemplate https://en.bitcoin.it/wiki/Getblocktemplate
     * BIP22 https://github.com/bitcoin/bips/blob/master/bip-0022.mediawiki
     * BIP23 https://github.com/bitcoin/bips/blob/master/bip-0023.mediawiki
     *
     * @param null|array $params see wiki for details
     * @return mixed
     */
    public function getBlockTemplate(array $params = null)
    {
        $params ?: ['capabilities' => ["coinbasetxn", "workid", "coinbase/append"]];
        return $this->send('getblocktemplate',$params);
    }

    /**
     * The getmininginfo RPC returns various mining-related information.
     *
     * @return mixed
     */
    public function getMiningInfo()
    {
        return $this->send('getmininginfo');
    }

    /**
     * The getnetworkhashps RPC returns the estimated current or historical
     * network hashes per second based on the last n blocks.
     *
     * @param int $blocks The number of blocks to average together for calculating
     * the estimated hashes per second. Default is 120. Use -1 to average all
     * blocks produced since the last difficulty change
     * @param int $height The height of the last block to use for calculating the
     * average. Defaults to -1 for the highest-height block on the local best block
     * chain. If the specified height is higher than the highest block on the local
     * best block chain, it will be interpreted the same as -1
     * @return mixed
     */
    public function getNetworkHashPS($blocks,$height)
    {
        return $this->send('getnetworkhashps',[$blocks,$height]);
    }

    /**
     * The prioritisetransaction RPC adds virtual priority or fee to a transaction,
     * allowing it to be accepted into blocks mined by this node (or miners which
     * use this node) with a lower priority or fee. (It can also remove virtual
     * priority or fee, requiring the transaction have a higher priority or fee to
     * be accepted into a locally-mined block.)
     *
     * @param string $txid The TXID of the transaction whose virtual priority or
     * fee you want to modify, encoded as hex in RPC byte order
     * @param float $priority If positive, the priority to add to the transaction
     * in addition to its computed priority; if negative, the priority to subtract
     * from the transaction’s computed priory. Computed priority is the age of each
     * input in days since it was added to the block chain as an output (coinage)
     * times the value of the input in satoshis (value) divided by the size of the
     * serialized transaction (size), which is coinage * value / size
     * @param int $fee Warning: this value is in satoshis, not bitcoins
     * If positive, the virtual fee to add to the actual fee paid by the transaction;
     * if negative, the virtual fee to subtract from the actual fee paid by the
     * transaction. No change is made to the actual fee paid by the transaction
     * @return mixed
     */
    public function prioritiseTransaction($txid,$priority,$fee)
    {
        return $this->send('prioritisetransaction',[$txid,$priority,$fee]);
    }

    /**
     * The submitblock RPC accepts a block, verifies it is a valid addition to the block
     * chain, and broadcasts it to the network. Extra parameters are ignored by Bitcoin
     * Core but may be used by mining pools or other programs.
     *
     * @param string $block The full block to submit in serialized block format as hex
     * @param string $json_params A JSON object containing extra parameters. Not used
     * directly by Bitcoin Core and also not broadcast to the network. This is available
     * for use by mining pools and other software. A common parameter is a workid string
     * @return mixed
     */
    public function submitBlock($block,$json_params = null)
    {
        return $this->send('submitblock',[$block,$json_params]);
    }
}