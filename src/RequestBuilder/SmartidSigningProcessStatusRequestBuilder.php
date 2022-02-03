<?php


namespace AppBundle\GatewaySDKPhp\RequestBuilder;

use AppBundle\GatewaySDKPhp\Model\Request;
use AppBundle\GatewaySDKPhp\Model\RequestInterface;
use AppBundle\GatewaySDKPhp\RequestBuilder\Traits\TraitBuildParameters;
use AppBundle\GatewaySDKPhp\RequestBuilder\Annotations\RequestParameter;

class SmartidSigningProcessStatusRequestBuilder extends AbstractRequestBuilder
{
    use TraitBuildParameters;

    /**
     * Token received from /smartid/sign call
     * 
     * @var string
     * @RequestParameter(name = "token")
     */
    protected $token;

    /**
     * API access token
     * 
     * @var string
     * @RequestParameter(name = "access_token")
     */
    protected $accessToken;

    /**
     * Set Token received from /smartid/sign call
     *
     * @param  string  $token
     *
     * @return  self
     */ 
    public function withToken(string $token)
    {
        $this->token = $token;

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
        
        $this->validateParameters(['token', 'access_token']);
        
        $request = new Request();
        $request->setApiName(Request::API_NAME_SMART_ID_SIGNING_STATUS);
        
        $request->setBodyParameters($this->bodyParams);

        return $request;
    }
}