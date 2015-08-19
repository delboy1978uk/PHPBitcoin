<?php
/**
 * User: delboy1978uk
 * Date: 18/08/15
 * Time: 19:58
 */

namespace Del\Bitcoin\Api;


class Utility extends AbstractApi
{

    /**
     * The createmultisig RPC creates a P2SH multi-signature address.
     *
     * @param int $num The minimum (m) number of signatures required to
     * spend this m-of-n multisig script
     * @return mixed
     */
    public function createMultiSig($num)
    {
        return $this->send('createmultisig');
    }

    /**
     * The estimatefee RPC estimates the transaction fee per kilobyte
     * that needs to be paid for a transaction to be included within
     * a certain number of blocks.
     *
     * @param int $blocks The maximum number of blocks a transaction
     * should have to wait before it is predicted to be included
     * in a block
     * @return mixed
     */
    public function estimateFee($blocks)
    {
        return $this->send('estimatefee',[$blocks]);
    }

    /**
     * The estimatepriority RPC estimates the priority that a transaction
     * needs in order to be included within a certain number of blocks as
     * a free high-priority transaction.
     *
     * @param $blocks
     * @return mixed
     */
    public function estimatePriority($blocks)
    {
        return $this->send('estimatepriority',[$blocks]);
    }

    /**
     * The validateaddress RPC returns information about
     * the given Bitcoin address.
     *
     * @param string $address The P2PKH or P2SH address to validate
     * encoded in base58check format
     * @return mixed
     */
    public function validateAddress($address)
    {
        return $this->send('validateaddress',[$address]);
    }

    /**
     * The verifymessage RPC verifies a signed message.
     *
     * @param string $address The P2PKH address corresponding to the private
     * key which made the signature. A P2PKH address is a hash of the public
     * key corresponding to the private key which made the signature. When
     * the ECDSA signature is checked, up to four possible ECDSA public keys
     * will be reconstructed from from the signature; each key will be hashed
     * and compared against the P2PKH address provided to see if any of them
     * match. If there are no matches, signature validation will fail.
     * @return mixed
     */
    public function verifyMessage($address)
    {
        return $this->send('verifymessage',[$address]);
    }
}