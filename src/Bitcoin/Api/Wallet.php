<?php
/**
 * User: delboy1978uk
 * Date: 18/08/15
 * Time: 20:00
 */

namespace Del\Bitcoin\Api;


class Wallet extends AbstractApi
{
    /**
     * The addmultisigaddress RPC adds a P2SH multisig address to the wallet.
     *
     * @param int $number The minimum (m) number of signatures required to spend
     * this m-of-n multisig script
     * @param string|array $addresses either
     * Keys Or Addresses	array	Required(exactly 1)
     *     An array of strings with each string being a public key or address
     * Key Or Address	string	Required(1 or more)
     *     A public key against which signatures will be checked. Alternatively,
     *     this may be a P2PKH address belonging to the wallet—the corresponding
     *     public key will be substituted. There must be at least as many keys as
     *     specified by the Required parameter, and there may be more keys
     * @return mixed
     */
    public function addMultiSigAddress($number,$addresses)
    {
        return $this->send('addmultisigaddress',[$number,$addresses]);
    }

    /**
     * The backupwallet RPC safely copies wallet.dat to the specified file, which
     * can be a directory or a path with filename.
     *
     * @param string $destination A filename or directory name. If a filename, it will
     * be created or overwritten. If a directory name, the file wallet.dat will be
     * created or overwritten within that directory
     * @return mixed
     */
    public function backupWallet($destination)
    {
        return $this->send('backupwallet',[$destination]);
    }

    /**
     * The dumpprivkey RPC returns the wallet-import-format (WIP) private key
     * corresponding to an address. (But does not remove it from the wallet.)
     *
     * @param string $p2pkh_address The P2PKH address corresponding to the private key
     * you want returned. Must be the address corresponding to a private key in this wallet
     * @return mixed
     */
    public function dumpPrivKey($p2pkh_address)
    {
        return $this->send('dumpprivkey',[$p2pkh_address]);
    }

    /**
     * The dumpwallet RPC creates or overwrites a file with all wallet keys in a
     * human-readable format.
     *
     * @param string $filename The file in which the wallet dump will be placed. May be
     * prefaced by an absolute file path. An existing file with that name will be
     * overwritten
     * @return mixed
     */
    public function dumpWallet($filename)
    {
        return $this->send('dumpwallet',[$filename]);
    }

    /**
     * The encryptwallet RPC encrypts the wallet with a passphrase. This is only to enable
     * encryption for the first time. After encryption is enabled, you will need to enter
     * the passphrase to use private keys.
     *
     * Warning: if using this RPC on the command line, remember that your shell probably
     * saves your command lines (including the value of the passphrase parameter). In
     * addition, there is no RPC to completely disable encryption. If you want to return
     * to an unencrypted wallet, you must create a new wallet and restore your data from
     * a backup made with the dumpwallet RPC.
     *
     * @param string $passphrase
     * @return mixed
     */
    public function encryptWallet($passphrase)
    {
        return $this->send('encryptwallet',[$passphrase]);
    }

    /**
     * The getaccountaddress RPC returns the current Bitcoin address for receiving payments
     * to this account. If the account doesn’t exist, it creates both the account and a new
     * address for receiving payment. Once a payment has been received to an address,
     * future calls to this RPC for the same account will return a different address.
     *
     * @param string $account The name of an account. Use an empty string (“”) for the
     * default account. If the account doesn’t exist, it will be created
     * @return mixed
     */
    public function getAccountAddress($account)
    {
        return $this->send('getaccountaddress',[$account]);
    }

    /**
     * The getaccount RPC returns the name of the account associated with the given address.
     *
     * @param string $address A P2PKH or P2SH Bitcoin address belonging either to a specific
     * account or the default account (“”)
     * @return mixed
     */
    public function getAccount($address)
    {
        return $this->send('getaccount',[$address]);
    }

    /**
     * The getaddressesbyaccount RPC returns a list of every address assigned to a
     * particular account.
     *
     * @param string $account The name of the account containing the addresses to
     * get. To get addresses from the default account, pass an empty string (“”)
     * @return mixed
     */
    public function getAddressesByAccount($account)
    {
        return $this->send('getaddressesbyaccount',[$account]);
    }

    /**
     * The getbalance RPC gets the balance in decimal bitcoins across all accounts
     * or for a particular account.
     *
     * @param string $account The name of an account to get the balance for. An
     * empty string (“”) is the default account. The string * will get the balance
     * for all accounts (this is the default behavior)
     * @param int $confirmations The minimum number of confirmations an
     * externally-generated transaction must have before it is counted towards the
     * balance. Transactions generated by this node are counted immediately. Typically,
     * externally-generated transactions are payments to this wallet and transactions
     * generated by this node are payments to other wallets. Use 0 to count unconfirmed
     * transactions. Default is 1
     * @param bool $inc_watch_only
     * @return mixed
     */
    public function getBalance($account = '*',$confirmations = 1,$inc_watch_only = false)
    {
        return $this->send('getbalance',[$account,$confirmations,$inc_watch_only]);
    }

    /**
     * The getnewaddress RPC returns a new Bitcoin address for receiving payments. If an
     * account is specified, payments received with the address will be credited to that
     * account.
     *
     * @param string $account The name of the account to put the address in. The default
     * is the default account, an empty string (“”)
     * @return mixed
     */
    public function getNewAddress($account)
    {
        return $this->send('getnewaddress',[$account]);
    }

    /**
     * The getrawchangeaddress RPC returns a new Bitcoin address for receiving change.
     * This is for use with raw transactions, not normal use.
     *
     * @return mixed
     */
    public function getRawChangeAddress()
    {
        return $this->send('getrawchangeaddress');
    }

    /**
     * The getreceivedbyaccount RPC returns the total amount received by addresses in a
     * particular account from transactions with the specified number of confirmations.
     * It does not count coinbase transactions.
     *
     * @param string $account The name of the account containing the addresses to get.
     * For the default account, use an empty string (“”)
     * @return mixed
     */
    public function getReceivedByAccount($account)
    {
        return $this->send('getreceivedbyaccount',[$account]);
    }

    /**
     * The getreceivedbyaddress RPC returns the total amount received by the specified
     * address in transactions with the specified number of confirmations. It does not
     * count coinbase transactions.
     *
     * @param string $address The address whose transactions should be tallied
     * @return mixed
     */
    public function getReceivedByAddress($address)
    {
        return $this->send('getreceivedbyaddress',[$address]);
    }

    /**
     * The gettransaction RPC gets detailed information about an in-wallet transaction.
     *
     * @param string $txid The TXID of the transaction to get details about. The TXID must be
     * encoded as hex in RPC byte order
     * @param bool $inc_watch_only If set to true, include watch-only addresses in details
     * and calculations as if they were regular addresses belonging to the wallet. If set
     * to false (the default), treat watch-only addresses as if they didn’t belong to this
     * wallet
     * @return mixed
     */
    public function getTransaction($txid,$inc_watch_only = false)
    {
        return $this->send('gettransaction',[$txid,$inc_watch_only]);
    }

    /**
     * The getunconfirmedbalance RPC returns the wallet’s total unconfirmed balance.
     *
     * @return mixed
     */
    public function getUnconfirmedBalance()
    {
        return $this->send('getunconfirmedbalance');
    }

    /**
     * The getwalletinfo RPC provides information about the wallet.
     *
     * @return mixed
     */
    public function getWalletInfo()
    {
        return $this->send('getwalletinfo');
    }

    /**
     * The importaddress RPC adds an address or pubkey script to the wallet without the
     * associated private key, allowing you to watch for transactions affecting that address
     * or pubkey script without being able to spend any of its outputs.
     *
     * @param string $address Either a P2PKH or P2SH address encoded in base58check, or a
     * pubkey script encoded as hex
     * @param string $account An account name into which the address should be placed. Default
     * is the default account, an empty string(“”)
     * @param bool $rescan Set to true (the default) to rescan the entire local block database
     * for transactions affecting any address or pubkey script in the wallet (including
     * transaction affecting the newly-added address or pubkey script). Set to false to not
     * rescan the block database (rescanning can be performed at any time by restarting Bitcoin
     * Core with the -rescan command-line argument). Rescanning may take several minutes. Notes:
     * if the address or pubkey script is already in the wallet, the block database will not be
     * rescanned even if this parameter is set
     * @return mixed
     */
    public function importAddress($address,$account = '',$rescan = true)
    {
        return $this->send('importaddress',[$address,$account,$rescan]);
    }

    /**
     * The importprivkey RPC adds a private key to your wallet. The key should be formatted in
     * the wallet import format created by the dumpprivkey RPC.
     *
     * @param $key
     * @param string $account
     * @param bool $rescan
     * @return mixed
     */
    public function importPrivKey($key,$account = '',$rescan = true)
    {
        return $this->send('importprivkey',[$key,$account,$rescan]);
    }

    /**
     * The importwallet RPC imports private keys from a file in wallet dump file format
     * (see the dumpwallet RPC). These keys will be added to the keys currently in the
     * wallet. This call may need to rescan all or parts of the block chain for transactions
     * affecting the newly-added keys, which may take several minutes.
     *
     * @param string $filename The file to import. The path is relative to Bitcoin Core’s
     * working directory
     * @return mixed
     */
    public function importWallet($filename)
    {
        return $this->send('importwallet',[$filename]);
    }

    /**
     * The keypoolrefill RPC fills the cache of unused pre-generated keys (the keypool).
     *
     * @param $size
     * @return mixed
     */
    public function keyPoolRefill($size)
    {
        return $this->send('',[$size]);
    }

    /**
     * The listaccounts RPC lists accounts and their balances.
     *
     * @param int $confirmations The minimum number of confirmations an externally-generated
     * transaction must have before it is counted towards the balance. Transactions generated
     * by this node are counted immediately. Typically, externally-generated transactions are
     * payments to this wallet and transactions generated by this node are payments to other
     * wallets. Use 0 to count unconfirmed transactions. Default is 1
     * @param bool $inc_watch_only If set to true, include watch-only addresses in details and
     * calculations as if they were regular addresses belonging to the wallet. If set to false
     * (the default), treat watch-only addresses as if they didn’t belong to this wallet
     * @return mixed
     */
    public function listAccounts($confirmations = 1, $inc_watch_only = false)
    {
        return $this->send('listaccounts',[$confirmations,$inc_watch_only]);
    }

    /**
     * The listaddressgroupings RPC lists groups of addresses that may have had their common
     * ownership made public by common use as inputs in the same transaction or from being
     * used as change from a previous transaction.
     *
     * @return mixed
     */
    public function listAddressGroupings()
    {
        return $this->send('listaddressgroupings');
    }

    /**
     * The lockunspent RPC temporarily locks or unlocks specified transaction outputs. A
     * locked transaction output will not be chosen by automatic coin selection when spending
     * bitcoins. Locks are stored in memory only, so nodes start with zero locked outputs and
     * the locked output list is always cleared when a node stops or fails.
     *
     * @param bool $unlock Set to false to lock the outputs specified in the following parameter.
     * Set to true to unlock the outputs specified. If this is the only argument specified and
     * it is set to true, all outputs will be unlocked; if it is the only argument and is set to
     * false, there will be no change
     * @param mixed $outputs either of the 4 below options:
     * Outputs	array	Optional (0 or 1)	An array of outputs to lock or unlock
     * Output	object	Required (1 or more)	An object describing a particular output
     * txid	string	Required (exactly 1)	The TXID of the transaction containing the output
     *     to lock or unlock, encoded as hex in internal byte order
     * vout	number (int)	Required(exactly 1)	The output index number (vout) of the output
     *     to lock or unlock. The first output in a transaction has an index of 0
     * @return mixed
     */
    public function listLockUnspent($unlock,$outputs)
    {
        return $this->send('lockunspent',[$unlock,$outputs]);
    }

    /**
     * The listreceivedbyaccount RPC lists the total number of bitcoins received by each account.
     *
     * @param int $confirmations The minimum number of confirmations an externally-generated
     * transaction must have before it is counted towards the balance. Transactions generated
     * by this node are counted immediately. Typically, externally-generated transactions are
     * payments to this wallet and transactions generated by this node are payments to other
     * wallets. Use 0 to count unconfirmed transactions. Default is 1
     * @param bool $inc_empty Set to true to display accounts which have never received a payment.
     * Set to false (the default) to only include accounts which have received a payment. Any account
     * which has received a payment will be displayed even if its current balance is 0
     * @param bool $inc_watch_only If set to true, include watch-only addresses in details and
     * calculations as if they were regular addresses belonging to the wallet. If set to false
     * (the default), treat watch-only addresses as if they didn’t belong to this wallet
     * @return mixed
     */
    public function listReceivedByAccount($confirmations = 1,$inc_empty = false,$inc_watch_only = false)
    {
        return $this->send('listreceivedbyaccount',[$confirmations,$inc_empty,$inc_watch_only]);
    }

    /**
     * The listreceivedbyaddress RPC lists the total number of bitcoins received by each address.
     *
     * @param int $confirmations The minimum number of confirmations an externally-generated
     * transaction must have before it is counted towards the balance. Transactions generated
     * by this node are counted immediately. Typically, externally-generated transactions are
     * payments to this wallet and transactions generated by this node are payments to other
     * wallets. Use 0 to count unconfirmed transactions. Default is 1
     * @param bool $inc_empty Set to true to display accounts which have never received a payment.
     * Set to false (the default) to only include accounts which have received a payment. Any account
     * which has received a payment will be displayed even if its current balance is 0
     * @param bool $inc_watch_only If set to true, include watch-only addresses in details and
     * calculations as if they were regular addresses belonging to the wallet. If set to false
     * (the default), treat watch-only addresses as if they didn’t belong to this wallet
     * @return mixed
     */
    public function listReceivedByAddress($confirmations = 1,$inc_empty = false,$inc_watch_only = false)
    {
        return $this->send('',[$confirmations,$inc_empty,$inc_watch_only]);
    }

    public function listSinceBlock()
    {
        return $this->send('',[]);
    }

    public function listTransactions()
    {
        return $this->send('',[]);
    }

    public function listUnspent()
    {
        return $this->send('',[]);
    }

    public function lockUnspent()
    {
        return $this->send('',[]);
    }

    public function move()
    {
        return $this->send('',[]);
    }

    public function sendFrom()
    {
        return $this->send('',[]);
    }

    public function sendMany()
    {
        return $this->send('',[]);
    }

    public function sendToAddress()
    {
        return $this->send('',[]);
    }

    public function setAccount()
    {
        return $this->send('',[]);
    }

    public function setTxFee()
    {
        return $this->send('',[]);
    }

    public function signMessage()
    {
        return $this->send('',[]);
    }

    public function walletLock()
    {
        return $this->send('',[]);
    }

    public function walletPassphrase()
    {
        return $this->send('',[]);
    }

    public function walletPassphraseChange()
    {
        return $this->send('',[]);
    }
}