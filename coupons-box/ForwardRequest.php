<?php

namespace CouponsBox;

use Psr\Http\Message\ResponseInterface;

interface ForwardRequest
{
    public function get(string $url, array $arguments) : ResponseInterface;
}