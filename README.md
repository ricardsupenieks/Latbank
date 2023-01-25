# Latbank - Banking and Crpyto site

## Main features

### Banking
* User registration, validation and authorization
* Bank account creation, with the choice of picking any currency 
* Deposit and withdraw funds
* Transfer funds between users or user accounts
* Transaction history
* Precise currency exchange rates

### Crypto
* Current crypto market statistics
* Buy and sell crypto currencies
* Transaction history

##
## Requirements
* PHP version: 7.4 
* MySQL version: 8.0.31
* Laravel 8.83.27

## Installation
1. Clone this repository
2. Run npm install in terminal
3. Create an account on https://exchangeratesapi.io/ to get the EXCHANGE_RATES_API_KEY
4. Create an account on https://coinmarketcap.com/ to get the COIN_MARKET_CAP_API_KEY
5. Rename ".env.example" to ".env" and enter the correct information in the parenthesis
6. Import the "schema.sql"
7. Run php artisan migrate in terminal
8. You can run the development website by typing the following command in terminal: php artisan serve

## Demo

# Landing Page
!()[https://github.com/ricardsupenieks/Latbank/blob/main/demo/mainPageLogin.png]

# Accounts Overview
!()[https://github.com/ricardsupenieks/Latbank/blob/main/demo/accounts.png]

# Account Overview
!()[https://github.com/ricardsupenieks/Latbank/blob/main/demo/account.gif]

# Transactions
!()[https://github.com/ricardsupenieks/Latbank/blob/main/demo/transactions.gif]

# Transfer
!()[https://github.com/ricardsupenieks/Latbank/blob/main/demo/transfer.gif]

# Crypto Market
!()[https://github.com/ricardsupenieks/Latbank/blob/main/demo/cryptos.gif]

# Buying Cryptos
!()[https://github.com/ricardsupenieks/Latbank/blob/main/demo/buy.gif]

# Selling Cryptos
!()[https://github.com/ricardsupenieks/Latbank/blob/main/demo/sell.gif]
