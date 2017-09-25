<?php

namespace Tests\Feature;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiGetCouponTest extends TestCase
{

    public function testItCanMakeASimpleGetRequest()
    {
        $this->fixture(new Response(200, [], "{}"));

        $response = $this->get('/coupons/1');

        $response->assertStatus(200);
    }

    public function testItCanMakeAGetRequestWithFilters()
    {
        $this->fixture(new Response(200, [], '{"brand":"Tesco", "value": 10}'));

        $response = $this->get('/coupons/1?brand=Tesco&value=10');

        $response->assertStatus(200);

        $this->assertJson($response->content());

        $this->assertJsonStringEqualsJsonString('{"brand":"Tesco", "value": 10}', $response->content());
    }

    public function testItRequiresALimitParameter()
    {
        $this->fixture(new Response(200, [], "{}"));

        $response = $this->get('/coupons');

        $response->assertStatus(404);
    }


    private function fixture(Response $response)
    {
        $client = \Mockery::mock(ClientInterface::class);
        $client->shouldReceive('request')->andReturn($response);

        $this->app->singleton(
            ClientInterface::class,
            function () use ($client) {
                return $client;
            }
        );
    }
}
