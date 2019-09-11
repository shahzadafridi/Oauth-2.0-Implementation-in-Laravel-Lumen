# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://poser.pugx.org/laravel/lumen-framework/d/total.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/lumen-framework/v/stable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/lumen-framework/v/unstable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://poser.pugx.org/laravel/lumen-framework/license.svg)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

## Client id
Client_id : 2

## Client Secret
Client_secret: j2kC50ZbHolBQsle4pa7yr7zUxXPrQXUeInkIrel

# Demo Site
here is the demo site where you can interact with ouath 2 api.
[Click here to Demo Site](https://shahzadafridi10.000webhostapp.com/home). 

## Registration
![Oauth - Registartion](https://i.imgur.com/9RVcnmN.png)

## Token Generation
![Oauth - Token](https://i.imgur.com/aypsO3W.png)


## Refresh Token 
There is a minior bug in url. To Refresh token, just back to home [Click home](https://shahzadafridi10.000webhostapp.com/home) page then do refersh token operation.

refrest_token: At time of new token generation then there is two keys one is token and second is refresh token so to refresh token then pass the last time generated token api -> refesh token. It will work only one time.

e-g 

If I pass refresh token of last time generated token api -> refresh token. It will give me new token and refersh token so next time we will use these.

![Oauth - Refresh Token](https://i.imgur.com/Sh8mEaK.png)

## Login
Login is not working at the moment. I will updat the code soon.


# Postman collection of API's

Explore api from postman documentation. [Here is the complete Postman documentation](https://documenter.getpostman.com/view/4771623/SVfRuoJ1?version=latest).

#database
This is Oauth table. You can use this clinet_id as column name id and client_secret in order to generate token.
![Database - Oauth Table](https://i.imgur.com/g8bdYRI.png)

![Database - User Table](https://i.imgur.com/IBG3PNe.png)


## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

