# Coupon-Box PHP service

### Solution

- The solution is self-contained and implemented in the [coupon-box](./coupons-box) folder.

- It ties with the Laravel framework through the [routing file](./routes/web.php) which calls [CouponsController.php](./app/Http/Controllers/CouponsController.php)

- Dependency Injection file is done through [CouponsBoxProvider.php](./app/Providers/CouponsBoxProvider.php) to inject a concrete Guzzle Client wherever needed.

- Unit testing is in [ForwardCouponRequest.php](./tests/Feature/ForwardCouponRequestTest.php).

- API testing is in  [ApiGetCouponTest.php](./tests/Feature/ApiGetCouponTest.php).

### Description

This service accepts a GET request from a client, forwards it to a remote Go Coupon service and sends back the response to the client in a synchronous fashion without any alterations, decorations, filtering.

### Scope

Part of the microservices suite for the Coupon Box project

### Dependencies

Needs the exact URL and port of the remote Go Coupon service.

- Guzzle
- PHPunit
- Mockery

### Installation

Clone this repository and :

`mv .env.example .env`

`php artisan key:generate`

`composer install`

`php artisan optimize`


##### Requirements

Requires <= PHP 7.0.0

### API

Accepts a RESTful GET request :

`/coupons/limit?brand={brand}&value={value}`

returns format depends on the remote Go service.

##### Exceptions

Following exceptions are thrown :

- *RouteRequestException* : Could not find the URL for the request endpoint.


- *ForwardRequestException* : When there is an error while trying to call the remote Go service or when receiving the response.


### Deployment

Use Laravel framework integrated web server :

`nohup php artisan serve &`

### Tests

Includes a test suite :

`./vendor/bin/phpunit`

