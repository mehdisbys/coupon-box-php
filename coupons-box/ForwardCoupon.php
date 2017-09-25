<?php


namespace CouponsBox;

class ForwardCoupon
{
    private $client;

    public function __construct(ForwardClient $client)
    {
        $this->client = $client;
    }

    public function forward(CouponsRequest $request): CouponsResponse
    {
        $response = NULL;
        $endpoint = $this->findRoute($request->getEndpoint());

        try {
            $response = $this->client->get($endpoint, $request->toArray());
        } catch (\Throwable $exception) {
            throw new ForwardRequestException("Could not contact coupon service {$exception->getMessage()}");
        }

        return new CouponsResponse($response->getBody()->getContents());
    }

    private function findRoute(string $endpoint): string
    {
        /* Routing table could loaded from configuration file or distant service */
        $routes = [
            '/coupons' => 'http://localhost:9999/get-coupon'
        ];

        if (isset($routes[$endpoint]) == false) {
            throw new RouteRequestException("$endpoint endpoint not found in ForwardCoupon::findRoute() ");
        }

        return $routes[$endpoint];
    }
}