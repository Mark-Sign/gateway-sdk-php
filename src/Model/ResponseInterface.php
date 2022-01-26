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
}