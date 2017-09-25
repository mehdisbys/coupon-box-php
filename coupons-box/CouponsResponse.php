<?php


namespace CouponsBox;


class CouponsResponse
{
    /** @var  string */
    private $response;

    /**
     * CouponsResponse constructor.
     * @param string $response
     */
    public function __construct(string $response)
    {
        $this->response = $response;
    }

    /**
     * @return string
     */
    public function getResponse(): string
    {
        return $this->response;
    }

}