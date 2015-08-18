# PHPBitcoin
[![Build Status](https://travis-ci.org/delboy1978uk/PHPBitcoin.png?branch=master)](https://travis-ci.org/delboy1978uk/PHPBitcoin) [![Code Coverage](https://scrutinizer-ci.com/g/delboy1978uk/PHPBitcoin/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/delboy1978uk/PHPBitcoin/?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/delboy1978uk/PHPBitcoin/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/delboy1978uk/PHPBitcoin/?branch=master) <br />
A PHP service for connecting to bitcoind. Also compatible with Zend Framework 2
##Usage
still in development
*tests
*basic usage
*zf2 module
##Installing bitcoind for developing with
puPHPet files for Vagrant included. Just vagrant up, vagrant ssh, then install Bitcoin. Unfortunately the ability to add custom repositories is not in puPHPet (yet. see https://github.com/puphpet/puphpet/issues/142)
```
sudo apt-get install python-software-properties
add-apt-repository ppa:bitcoin/bitcoin
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