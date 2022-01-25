<?php


namespace AppBundle\GatewaySDKPhp\src\RequestBuilder;


use AppBundle\GatewaySDKPhp\src\Model\RequestInterface;

interface RequestBuilderInterface
{
    /**
     * @param string $secret
     * @return self
     */
    public function withApiKey(string $secret): self;

    /**
     * @return RequestInterface
     */
    public function createRequest(): RequestInterface;
}