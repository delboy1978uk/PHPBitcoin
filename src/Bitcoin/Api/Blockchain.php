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
     * @param string $header_hash The hash of the header of the block to get,
     * encoded as hex in RPC byte order
     * @param bool $json Set to false to get the block in serialized block format;
     * set to true (the default) to get the decoded block as a JSON object
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
     * @param int $height The height of the block whose header hash
     * should be returned. The height of the hardcoded genesis block is 0
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
     * @param bool $format Set to true to get verbose output describing
     * each transaction in the memory pool; set to false (the default) to
     * only get an array of TXIDs for transactions in the memory pool
     * @return mixed
     */
    public function getRawMemPool($format = false)
    {
        return $this->send('getrawmempool',[$format]);
    }

    /**
     * The gettxout RPC returns details about a transaction output.
     * Only unspent transaction outputs (UTXOs) are guaranteed to be
     * available.
     *
     * @param string $txid The TXID of the transaction containing the
     * output to get, encoded as hex in RPC byte order
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
     * @param int $check_level How thoroughly to check each block,
     * from 0 to 4. Default is the level set with the -checklevel command
     * line argument; if that isn’t set, the default is 3. Each higher
     * level includes the tests from the lower levels
     * Levels are:
     * 0. Read from disk to ensure the files are accessible
     * 1. Ensure each block is valid
     * 2. Make sure undo files can be read from disk and are in a valid format
     * 3. Test each block undo to ensure it results in correct state
     * 4. After undoing blocks, reconnect them to ensure they reconnect correctly
     * @param int $num_blocks The number of blocks to verify. Set to 0 to check
     * all blocks. Defaults to the value of the -checkblocks command-line
     * argument; if that isn’t set, the default is 288
     * @return mixed
     */
    public function verifyChain($check_level, $num_blocks)
    {
        return $this->send('verifychain',[$check_level,$num_blocks]);
    }
}