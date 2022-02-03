<?php


namespace AppBundle\GatewaySDKPhp\RequestBuilder;

use AppBundle\GatewaySDKPhp\Model\Request;
use AppBundle\GatewaySDKPhp\Model\RequestInterface;
use AppBundle\GatewaySDKPhp\RequestBuilder\Traits\TraitBuildParameters;
use AppBundle\GatewaySDKPhp\RequestBuilder\Annotations\RequestParameter;

class MobileidIDENTIFICATIONRemoveRequestBuilder extends AbstractRequestBuilder
{
    use TraitBuildParameters;

    /**
     * Unique request number
     * 
     * @var string
     * @RequestParameter(name = "sessionId")
     */
    protected $sessionId;

    /**
     * API access token
     * 
     * @var string
     * @RequestParameter(name = "access_token")
     */
    protected $accessToken;

    /**
     * Set Unique request number
     *
     * @param  string  $token
     *
     * @return  self
     */ 
    public function withSessionId(string $sessionId)
    {
        $this->sessionId = $sessionId;

        return $this;
    }

    /**
     * Set API access token
     *
     * @param  string  $accessToken
     *
     * @return  self
     */ 
    public function withAccessToken(string $accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    public function createRequest(): RequestInterface
    {
        $this->bodyParams = $this->buildParameters();
        
        $this->validateParameters(['sessionId', 'access_token']);
        
        $request = new Request();
        $request->setApiName(Request::API_NAME_MOBILE_ID_IDENTIFICATION_REMOVE);
        
        $request->setBodyParameters($this->bodyParams);

        return $request;
    }
}