<?php


namespace CouponsBox;


class CouponsRequest
{

    private $endpoint;
    private $limit;
    private $value;
    private $brand;

    /**
     * CouponsRequest constructor.
     * @param $limit
     * @param $value
     * @param $brand
     */
    public function __construct(string $endpoint, int $limit, string $value = NULL, string $brand = NULL)
    {
        $this->endpoint = $endpoint;
        $this->limit    = $limit;
        $this->value    = $value;
        $this->brand    = $brand;
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    public function toArray(): array
    {
        return ['limit' => $this->limit, 'value' => $this->value, 'brand' => $this->brand];
    }

}