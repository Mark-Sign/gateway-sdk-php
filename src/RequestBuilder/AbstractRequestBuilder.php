<?php


namespace AppBundle\GatewaySDKPhp\RequestBuilder;

use AppBundle\GatewaySDKPhp\Exception\MissingParameterException;
use AppBundle\GatewaySDKPhp\RequestBuilder\Annotations\RequestParameter;

abstract class AbstractRequestBuilder implements RequestBuilderInterface
{
    /**
     * @var string
     */
    protected $accessToken;

    /**
     * @RequestParameter(name = "access_token")
     * 
     * @param string $accessToken
     * @return RequestBuilderInterface
     */
    public function withAccessToken(string $accessToken): RequestBuilderInterface
    {
        $this->accessToken = $accessToken;

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