<?php


namespace AppBundle\GatewaySDKPhp\RequestBuilder;

use AppBundle\GatewaySDKPhp\Exception\MissingParameterException;

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

    /**
     * @var array
     */
    protected $bodyParams = [];

    /**
     * @throws MissingParameterException
     */
    protected function validateParameters(array $requiredParams)
    {
        foreach ($requiredParams as $param) {
            if (!isset($this->bodyParams[$param])) {
                throw new MissingParameterException("Missing required request parameter '{$param}'");
            }
        }
    }
}