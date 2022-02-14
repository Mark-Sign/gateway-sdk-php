<?php


namespace AppBundle\GatewaySDKPhp;


use AppBundle\GatewaySDKPhp\Model\RequestInterface;
use AppBundle\GatewaySDKPhp\Model\ResponseInterface;

interface ConnectorInterface
{
    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function postRequest(RequestInterface $request);
}