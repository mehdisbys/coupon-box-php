<?php

namespace Tests\Feature;

use CouponsBox\CouponsRequest;
use CouponsBox\CouponsResponse;
use CouponsBox\ForwardClient;
use CouponsBox\ForwardCoupon;
use CouponsBox\ForwardRequestException;
use CouponsBox\RouteRequestException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Tests\TestCase;

class ForwardCouponTest extends TestCase
{

    public function testItCanForwardARequestAndReturnAResponse()
    {
        $request  = new CouponsRequest('/coupons', 1, 10, 'Tesco');
        $fwd      = $this->fixture(new Response());
        $response = $fwd->forward($request);
        $this->assertInstanceOf(CouponsResponse::class, $response);
    }

    public function testItThrowsAnExceptionIfRouteIsNotFound()
    {
        $request = new CouponsRequest('/cupon-misspell', 1, 10, 'Tesco');
        $client  = \Mockery::mock(ClientInterface::class);
        $client->shouldReceive('request')->andThrow(new \Exception());
        $client = new ForwardClient($client);
        $fwd    = new ForwardCoupon($client);

        $this->expectException(RouteRequestException::class);
        $fwd->forward($request);
    }

    public function testItThrowsAnExceptionIfForwardingFails()
    {
        $request = new CouponsRequest('/coupons', 1, 10, 'Tesco');
        $client  = \Mockery::mock(ClientInterface::class);
        $client->shouldReceive('request')->andThrow(new \Exception());
        $client = new ForwardClient($client);
        $fwd    = new ForwardCoupon($client);

        $this->expectException(ForwardRequestException::class);
        $fwd->forward($request);
    }


    private function fixture(ResponseInterface $response)
    {
        $client = \Mockery::mock(ClientInterface::class);
        $client->shouldReceive('request')->andReturn($response);
        $client = new ForwardClient($client);
        return new ForwardCoupon($client);
    }

}
