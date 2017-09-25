<?php

namespace App\Http\Controllers;

use CouponsBox\CouponsRequest;
use CouponsBox\ForwardClient;
use CouponsBox\ForwardCoupon;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;

class CouponsController extends Controller
{

    private $clientInstance;

    public function __construct(ClientInterface $client)
    {
        $this->clientInstance = $client;
    }

    public function get(int $limit)
    {
        $endpoint = Route::current()->getCompiled()->getStaticPrefix();
        $value    = Input::get('value');
        $brand    = Input::get('brand');

        $request  = new CouponsRequest($endpoint, $limit, $value, $brand);
        $client   = new ForwardClient($this->clientInstance);
        $fwd      = new ForwardCoupon($client);
        $response = $fwd->forward($request);

        return $response->getResponse();
    }
}
