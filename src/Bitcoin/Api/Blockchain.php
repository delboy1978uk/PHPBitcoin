<?php
/**
 * User: delboy1978uk
 * Date: 18/08/15
 * Time: 19:43
 */

namespace Del\Bitcoin\Api;


class Blockchain extends AbstractApi
{

    /**
     * returns the header hash of the most recent block on the best block chain.
     *
     * @return mixed
     */
    public function getBestBlockHash()
    {
        return $this->send('getbestblockhash');
    }

    /**
     * The getblock RPC gets a block with a particular header hash from
     * the local block database either as a JSON object
     * or as a serialized block.
     *
     * @param string $header_hash
     * @param bool $json
     * @return mixed
     */
    public function getBlock($header_hash,$json = true)
    {
        return $this->send('getblock',[$header_hash,$json]);
    }

    /**
     * The getblockchaininfo RPC provides information about
     * the current state of the block chain.
     *
     * @return mixed
     */
    public function getBlockChainInfo()
    {
        return $this->send('getblockchaininfo');
    }

    /**
     * The getblockcount RPC returns the number of blocks in
     * the local best block chain.
     *
     * @return mixed
     */
    public function getBlockCount()
    {
        return $this->send('getblockcount');
    }

    /**
     * The getblockhash RPC returns the header hash of a block
     * at the given height in the local best block chain.
     *
     * @param $height
     * @return mixed
     */
    public function getBlockHash($height)
    {
        return $this->send('getblockhash',[$height]);
    }

    /**
     * The getchaintips RPC returns information about the
     * highest-height block (tip) of each local block chain.
     *
     * @return mixed
     */
    public function getChainTips()
    {
        return $this->send('getchaintips');
    }

    /**
     * The getdifficulty RPC
     *
     * @return mixed
     */
    public function getDifficulty()
    {
        return $this->send('getdifficulty');
    }

    /**
     * The getmempoolinfo RPC returns information about
     * the node’s current transaction memory pool.
     *
     * @return mixed
     */
    public function getMemPoolInfo()
    {
        return $this->send('getmempoolinfo');
    }

    /**
     * The getrawmempool RPC returns all transaction identifiers (TXIDs)
     * in the memory pool as a JSON array, or detailed information about
     * each transaction in the memory pool as a JSON object.
     *
     * @param bool $verbose
     * @return mixed
     */
    public function getRawMemPool($verbose = false)
    {
        return $this->send('getrawmempool',[$verbose]);
    }

    /**
     * The gettxout RPC returns details about a transaction output.
     * Only unspent transaction outputs (UTXOs) are guaranteed to be
     * available.
     *
     * @param string $txid a hex id
     * @return mixed
     */
    public function getTxOut($txid)
    {
        return $this->send('gettxout',[$txid]);
    }

    /**
     * The gettxoutsetinfo RPC returns statistics about the confirmed
     * unspent transaction output (UTXO) set. Note that this call may
     * take some time and that it only counts outputs from confirmed
     * transactions—it does not count outputs from the memory pool.
     *
     * @return mixed
     */
    public function getTxOutSetInfo()
    {
        return $this->send('gettxoutsetinfo');
    }

    /**
     * The verifychain RPC verifies each entry in the local
     * block chain database.
     *
     * @param $check_level
     * @param $num_blocks
     * @return mixed
     */
    public function verifyChain($check_level, $num_blocks)
    {
        return $this->send('verifychain',[$check_level,$num_blocks]);
    }
}