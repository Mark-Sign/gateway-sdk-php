<?php


namespace AppBundle\GatewaySDKPhp\RequestBuilder;

use AppBundle\GatewaySDKPhp\Model\Request;
use AppBundle\GatewaySDKPhp\Model\RequestInterface;
use AppBundle\GatewaySDKPhp\RequestBuilder\Traits\TraitBuildParameters;
use AppBundle\GatewaySDKPhp\RequestBuilder\Annotations\RequestParameter;

class MobileidIdentificationRemoveRequestBuilder extends AbstractRequestBuilder
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
     * Builds the request object
     *
     * @return RequestInterface
     */
    public function createRequest(): RequestInterface
    {
        $this->bodyParams = $this->buildParameters();
        
        $this->validateParameters(['sessionId']);
        
        $request = new Request();
        $request->setApiName(Request::API_NAME_MOBILE_ID_IDENTIFICATION_REMOVE);
        
        $request->setBodyParameters($this->bodyParams);

        return $request;
    }
}