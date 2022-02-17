<?php


namespace AppBundle\GatewaySDKPhp\RequestBuilder;

use AppBundle\GatewaySDKPhp\Model\Request;
use AppBundle\GatewaySDKPhp\Model\RequestInterface;
use AppBundle\GatewaySDKPhp\RequestBuilder\Traits\TraitBuildParameters;
use AppBundle\GatewaySDKPhp\RequestBuilder\Annotations\RequestParameter;

class SmartidInitAuthRequestBuilder extends AbstractRequestBuilder
{
    use TraitBuildParameters;

    /**
     * Person code
     * 
     * @var string
     * @RequestParameter(name = "code")
     */
    protected $code;

    /**
     * Country related to person code: LT, LV, EE
     * 
     * @var string
     * @RequestParameter(name = "country")
     */
    protected $country;

    /**
     * Message displayed on the phone screen.
     * 
     * @var string
     * @RequestParameter(name = "message")
     */
    protected $message;

    /**
     * PEP's check
     * 
     * @var bool
     * @RequestParameter(name = "peps")
     */
    protected $peps;

    /**
     * Sanction check
     * 
     * @var bool
     * @RequestParameter(name = "sanctions")
     */
    protected $sanctions;

    /**
     * Set person code
     *
     * @param  string  $code  Person code
     *
     * @return  self
     */ 
    public function withCode(string $code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Set country related to person code: LT, LV, EE
     *
     * @param  string  $country  Country related to person code: LT, LV, EE
     *
     * @return  self
     */ 
    public function withCountry(string $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Set message displayed on the phone screen.
     *
     * @param  string  $message  Message displayed on the phone screen.
     *
     * @return  self
     */ 
    public function withMessage(string $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Set PEP's check
     *
     * @param  bool  $peps  PEP's check
     *
     * @return  self
     */ 
    public function withPeps(bool $peps)
    {
        $this->peps = $peps;

        return $this;
    }

    /**
     * Set sanction check
     *
     * @param  bool  $sanctions  Sanction check
     *
     * @return  self
     */ 
    public function withSanctions(bool $sanctions)
    {
        $this->sanctions = $sanctions;

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
        
        $this->validateParameters(['code', 'country']);
        
        $request = new Request();
        $request->setApiName(Request::API_NAME_SMART_ID_INIT_AUTH);
        
        $request->setBodyParameters($this->bodyParams);

        return $request;
    }
}