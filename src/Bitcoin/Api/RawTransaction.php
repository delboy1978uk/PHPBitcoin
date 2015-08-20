<?php
/**
 * User: delboy1978uk
 * Date: 18/08/15
 * Time: 19:57
 */

namespace Del\Bitcoin\Api;


class RawTransaction extends AbstractApi
{

    /**
     * The createrawtransaction RPC creates an unsigned serialized
     * transaction that spends a previous output to a new output with
     * a P2PKH or P2SH address. The transaction is not stored in the
     * wallet or transmitted to the network.
     *
     * @param string $refs json object
     * Outpoints 	array 	Required(exactly 1)
     *             An array of objects,each one being an unspent outpoint
     * Outpoint 	object 	Required(1 or more)
     *             An object describing a particular unspent outpoint
     * txid 	   string (hex) 	Required(exactly 1)
     *             The TXID of the outpoint encoded as hex in RPC byte order
     * vout 	   int	Require(exactly 1)
     *             The output index number (vout) of the outpoint;
     *             the first output in a transaction is index 0
     * @param string $addresses json objects
     * Outputs     object 	Required(exactly 1)
     *             The addresses and amounts to pay
     * Address/Amount 	string : number (bitcoins) 	Required(1 or more)
     *             A key/value pair with the address to pay as a string
     *             (key) and the amount to pay that address (value) in
     *             bitcoins
     * @return mixed
     */
    public function createRawTransaction($refs,$addresses)
    {
        return $this->send('createrawtransaction',[$refs,$addresses]);
    }

    /**
     * The decoderawtransaction RPC decodes a serialized transaction hex
     * string into a JSON object describing the transaction.\
     *
     * @param string $transaction (hex) The transaction to decode in
     * serialized transaction format
     * @return mixed
     */
    public function decodeRawTransaction($transaction)
    {
        return $this->send('decoderawtransaction',[$transaction]);
    }

    /**
     * The decodescript RPC decodes a hex-encoded P2SH redeem script.
     *
     * @param string $script The redeem script to decode as a
     * hex-encoded serialized script
     * @return mixed
     */
    public function decodeScript($script)
    {
        return $this->send('decodescript',[$script]);
    }

    /**
     * The getrawtransaction RPC gets a hex-encoded serialized transaction
     * or a JSON object describing the transaction. By default, Bitcoin Core
     * only stores complete transaction data for UTXOs and your own
     * transactions, so the RPC may fail on historic transactions unless you
     * use the non-default txindex=1 in your Bitcoin Core startup settings.
     *
     * Note: if you begin using txindex=1 after downloading the block chain,
     * you must rebuild your indexes by starting Bitcoin Core with the
     * option -reindex. This may take several hours to complete, during
     * which time your node will not process new blocks or transactions. This
     * reindex only needs to be done once.
     *
     * @param $txid
     * @param bool $verbose
     * @return mixed
     */
    public function getRawTransaction($txid,$verbose = false)
    {
        return $this->send('getrawtransaction',[$txid,$verbose]);
    }

    /**
     * The sendrawtransaction RPC validates a transaction and broadcasts it to
     * the peer-to-peer network.
     *
     * @param string $transaction The serialized transaction to broadcast
     * encoded as hex
     * @param bool $allow_high_fees Set to true to allow the transaction to pay
     * a high transaction fee. Set to false (the default) to prevent Bitcoin
     * Core from broadcasting the transaction if it includes a high fee.
     * Transaction fees are the sum of the inputs minus the sum of the outputs,
     * so this high fees check helps ensures user including a change address to
     * return most of the difference back to themselves
     * @return mixed
     */
    public function sendRawTransaction($transaction,$allow_high_fees = false)
    {
        return $this->send('sendrawtransaction',[$transaction,$allow_high_fees]);
    }

    /**
     * The signrawtransaction RPC signs a transaction in the serialized
     * transaction format using private keys stored in the wallet or provided in
     * the call.
     *
     * @param string $transaction The transaction to sign as a serialized
     * transaction
     * @param string $unspent json object
     * Dependencies 	array 	Optional(0 or 1)
     *                  The previous outputs being spent by this transaction
     * Output 	        object 	Optional(0 or more)
     *                  An output being spent
     * txid 	        string (hex) 	Required(exactly 1)
     *                  The TXID of the transaction the output appeared in. The
     *                  TXID must be encoded in hex in RPC byte order
     * @return mixed
     */
    public function signRawTransaction($transaction,$unspent)
    {
        return $this->send('signrawtransaction',[$transaction,$unspent]);
    }
}