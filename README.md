# PHPBitcoin
[![Build Status](https://travis-ci.org/delboy1978uk/PHPBitcoin.png?branch=master)](https://travis-ci.org/delboy1978uk/PHPBitcoin) [![Code Coverage](https://scrutinizer-ci.com/g/delboy1978uk/PHPBitcoin/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/delboy1978uk/PHPBitcoin/?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/delboy1978uk/PHPBitcoin/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/delboy1978uk/PHPBitcoin/?branch=master) <br />
A PHP service for connecting to bitcoind. Also compatible with Zend Framework 2
##Usage
```php
use Del\Bitcoin();

$config = [
    'username' => 'YOURUSERNAME', // required
    'password' => 'YOURPASSWORD', // required
    'host' => '127.0.0.1',    // default
    'port' => '8332',         // default
    'protocol' => 'http',     // default
    'ssl_certificate' => '',  // default
];

$btc = new Bitcoin($config);

//example
$info = $btc->getControlApi()->getInfo();
```
###API's
The Bitcoin object has access to each of the different API's available
```php
$btc->getBlockchainApi();
$btc->getControlApi();
$btc->getGeneratingApi();
$btc->getMiningApi();
$btc->getNetworkApi();
$btc->getRawTransactionApi();
$btc->getUtilityApi();
$btc->getWalletApi();
```
Each API has docblock comments from the actual API, so you should get nice code completion.
However the actual Bitcoin API docs can be found at https://bitcoin.org/en/developer-reference#rpc-quick-reference

##Usage in ZF2
Still todo
##Installing bitcoind for development
puPHPet files for Vagrant included. Just vagrant up, vagrant ssh, then install Bitcoin. Unfortunately the ability to add custom repositories is not in puPHPet (yet. see https://github.com/puphpet/puphpet/issues/142)
```
sudo apt-get install python-software-properties
sudo add-apt-repository --yes ppa:bitcoin/bitcoin
sudo apt-get update
sudo apt-get install libboost-all-dev libdb4.8-dev libdb4.8++-dev bitcoind
cd ~
mkdir .bitcoin
cd .bitcoin
nano bitcoin.conf
```
Put the following info in the conf file:
```
server=1
daemon=1
testnet=1
rpcuser=phpbitcoin
rpcpassword=COMPLETELYrandomPASSWORD
```
You should use the testnet option if developing, tests connect on port 18332! Finally run bitcoind by simply typing it
```
bitcoind
```