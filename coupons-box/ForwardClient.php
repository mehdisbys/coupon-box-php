<?php


namespace CouponsBox;


use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

class ForwardClient implements ForwardRequest
{
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function get(string $url, array $arguments) : ResponseInterface
    {
        return $this->client->request('GET', $url ,[ 'query' => $arguments]);
    }

}