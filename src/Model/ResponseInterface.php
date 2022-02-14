<?php


namespace AppBundle\GatewaySDKPhp\Model;


interface ResponseInterface
{
    /**
     * @return int
     */
    public function getStatusCode(): int;

    /**
     * @return string
     */
    public function getContent(): string;

    /**
     * @return array
     */
    public function toArray(): array;

    /**
     * @return array
     */
    public function getHeaders(): array;

    /**
     * @return mixed|null
     */
    public function getHeader(string $headerName): mixed|null;
}