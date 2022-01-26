<?php


namespace AppBundle\GatewaySDKPhp\RequestBuilder;


use AppBundle\GatewaySDKPhp\Model\RequestInterface;

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