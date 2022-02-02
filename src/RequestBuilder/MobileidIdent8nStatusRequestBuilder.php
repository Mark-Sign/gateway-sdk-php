<?php


namespace AppBundle\GatewaySDKPhp\RequestBuilder;

use AppBundle\GatewaySDKPhp\Model\Request;
use AppBundle\GatewaySDKPhp\Model\RequestInterface;
use AppBundle\GatewaySDKPhp\RequestBuilder\Traits\TraitBuildParameters;
use AppBundle\GatewaySDKPhp\RequestBuilder\Annotations\RequestParameter;

class MobileidIdent8nStatusRequestBuilder extends AbstractRequestBuilder
{
    use TraitBuildParameters;

    /**
     * Token received from /mobile/login call
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
     * Set Token received from /mobile/login call
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
        $request->setApiName(Request::API_NAME_MOBILE_ID_IDENT8N_SESSION_STATUS);
        
        $request->setBodyParameters($this->bodyParams);

        return $request;
    }
}