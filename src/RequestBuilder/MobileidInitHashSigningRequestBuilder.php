<?php


namespace AppBundle\GatewaySDKPhp\RequestBuilder;

use AppBundle\GatewaySDKPhp\Model\Request;
use AppBundle\GatewaySDKPhp\Model\RequestInterface;
use AppBundle\GatewaySDKPhp\RequestBuilder\Traits\TraitBuildParameters;
use AppBundle\GatewaySDKPhp\RequestBuilder\Annotations\RequestParameter;

class MobileidInitHashSigningRequestBuilder extends AbstractRequestBuilder
{
    use TraitBuildParameters;

    /**
     * API access token
     * 
     * @var string
     * @RequestParameter(name = "access_token")
     */
    protected $accessToken;

    /**
     * Hash to sign
     *
     * @var string
     * @RequestParameter(name = "hash")
     */
    protected $hash;

    /**
     * Phone number
     *
     * @var string
     * @RequestParameter(name = "phone")
     */
    protected $phone;

    /**
     * SHA256 or SHA512
     *
     * @var string
     * @RequestParameter(name = "hash_algorithm")
     */
    protected $hashAlgorithm;

    /**
     * Signer's country code: LT, EE
     *
     * @var string
     * @RequestParameter(name = "country")
     */
    protected $country;

    /**
     * Message displayed on screen. Attention: UTF-8 symbols are not allowed
     *
     * @var string
     * @RequestParameter(name = "message")
     */
    protected $message;

    /**
     * Personal code
     *
     * @var string
     * @RequestParameter(name = "code")
     */
    protected $code;

    /**
     * Set API access token
     *
     * @param  string  $accessToken  API access token
     *
     * @return  self
     */ 
    public function withAccessToken(string $accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * Set hash to sign
     *
     * @param  string  $hash  Hash to sign
     *
     * @return  self
     */ 
    public function withHash(string $hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Set phone number
     *
     * @param  string  $phone  Phone number
     *
     * @return  self
     */ 
    public function withPhone(string $phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Set sHA256 or SHA512
     *
     * @param  string  $hashAlgorithm  SHA256 or SHA512
     *
     * @return  self
     */ 
    public function withHashAlgorithm(string $hashAlgorithm)
    {
        $this->hashAlgorithm = $hashAlgorithm;

        return $this;
    }

    /**
     * Set signer's country code: LT, EE
     *
     * @param  string  $country  Signer's country code: LT, EE
     *
     * @return  self
     */ 
    public function withCountry(string $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Set message displayed on screen. Attention: UTF-8 symbols are not allowed
     *
     * @param  string  $message  Message displayed on screen. Attention: UTF-8 symbols are not allowed
     *
     * @return  self
     */ 
    public function withMessage(string $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Set personal code
     *
     * @param  string  $code  Personal code
     *
     * @return  self
     */ 
    public function withCode(string $code)
    {
        $this->code = $code;

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
        
        $this->validateParameters(['access_token', 'hash', 'phone', 'hash_algorithm', 'country', 'code']);
        
        $request = new Request();
        $request->setApiName(Request::API_NAME_MOBILE_ID_INIT_HASH_SIGNING);
        
        $request->setBodyParameters($this->bodyParams);

        return $request;
    }
}