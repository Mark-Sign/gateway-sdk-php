<?php


namespace AppBundle\GatewaySDKPhp;


use AppBundle\GatewaySDKPhp\src\Model\RequestInterface;
use AppBundle\GatewaySDKPhp\src\Model\ResponseInterface;

interface ConnectorInterface
{
    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function postRequest(RequestInterface $request): ResponseInterface;
}