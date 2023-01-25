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

## Requirements
* PHP version: 7.4 
* MySQL version: 8.0.31
* Laravel 8.83.27

## Installation
1. Clone this repository
2. Run npm install in terminal
3. Run php artisan migrate in terminal
5. Create an account on https://exchangeratesapi.io/ to get the EXCHANGE_RATES_API_KEY
6. Create an account on https://coinmarketcap.com/ to get the COIN_MARKET_CAP_API_KEY
7. Rename ".env.example" to ".env" and enter the correct information in the parenthesis
8. Import the "schema.sql"
9. You can run the development website by typing the following command in terminal: php artisan serve
