<?php


namespace AppBundle\GatewaySDKPhp\RequestBuilder;


abstract class AbstractRequestBuilder implements RequestBuilderInterface
{
    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @param string $apiKey
     * @return RequestBuilderInterface
     */
    public function withApiKey(string $apiKey): RequestBuilderInterface
    {
        $this->apiKey = $apiKey;

        return $this;
    }
}