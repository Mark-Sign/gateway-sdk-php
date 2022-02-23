<?php


namespace AppBundle\GatewaySDKPhp\RequestBuilder;

use AppBundle\GatewaySDKPhp\Model\Request;
use AppBundle\GatewaySDKPhp\Model\RequestInterface;
use AppBundle\GatewaySDKPhp\RequestBuilder\Traits\TraitBuildParameters;
use AppBundle\GatewaySDKPhp\RequestBuilder\Annotations\RequestParameter;

class SmartidIdentificationStatusRequestBuilder extends AbstractRequestBuilder
{
    use TraitBuildParameters;

    /**
     * Token received from /smartid/login call
     * 
     * @var string
     * @RequestParameter(name = "token")
     */
    protected $token;

    /**
     * Set Token received from /smartid/login call
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
     * Builds the request object
     *
     * @return RequestInterface
     */
    public function createRequest(): RequestInterface
    {
        $this->bodyParams = $this->buildParameters();
        
        $this->validateParameters(['token']);
        
        $request = new Request();
        $request->setApiName(Request::API_NAME_SMART_ID_IDENTIFICATION_SESSION_STATUS);
        
        $request->setBodyParameters($this->bodyParams);

        return $request;
    }
}