

## Uber basic php NationBuilder PHP Api client

This shows a very bare bones client that

1. Gets the auth code for a token
2. Redirects with the code to generate a token and stores it
3. Redirects back to the  page to display a few people records

The token is stored in a peristant store via the `TockenStore` class
This implementation uses Redis to store the token.


## Thanks To

* [ryanbrainard](https://github.com/ryanbrainard) - [heroku php redis buildpack](https://github.com/ryanbrainard/php-redis-heroku-demo)

* [nicolasff](https://github.com/nicolasff) - [phpredis](https://github.com/nicolasff/phpredis)

* [https://github.com/adoy](https://github.com/adoy/PHP-OAuth2) - [PHP-OAuth2 library](https://github.com/adoy/PHP-OAuth2)


### Here be dragons!
Use at your own risk.

