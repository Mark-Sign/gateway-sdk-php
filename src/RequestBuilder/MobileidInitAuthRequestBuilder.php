<?php


namespace AppBundle\GatewaySDKPhp\RequestBuilder;

use AppBundle\GatewaySDKPhp\Model\Request;
use AppBundle\GatewaySDKPhp\Model\RequestInterface;
use AppBundle\GatewaySDKPhp\RequestBuilder\Traits\TraitBuildParameters;
use AppBundle\GatewaySDKPhp\RequestBuilder\Annotations\RequestParameter;

class MobileidInitAuthRequestBuilder extends AbstractRequestBuilder
{
    use TraitBuildParameters;

    /**
     * Phone number
     * 
     * @var string
     * @RequestParameter(name = "phone")
     */
    protected $phone;

    /**
     * Personal code
     * 
     * @var string
     * @RequestParameter(name = "code")
     */
    protected $code;

    /**
     * Language for messages displayed on the phone screen (default: LIT, other: ENG, RUS, EST)
     * 
     * @var string
     * @RequestParameter(name = "language")
     */
    protected $language;

    /**
     * Message displayed on the phone screen.
     * 
     * @var string
     * @RequestParameter(name = "message")
     */
    protected $message;

    /**
     * Format of the message which is displayed on the phone screen. Possible values: GSM-7 (default), UCS-2. Max characters count for GSM-7 and UCS-2 is 40 and 20 characters respectively.
     * 
     * @var string
     * @RequestParameter(name = "message_format")
     */
    protected $messageFormat;

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
     * Set language for messages displayed on the phone screen (default: LIT, other: ENG, RUS, EST)
     *
     * @param  string  $language  Language for messages displayed on the phone screen (default: LIT, other: ENG, RUS, EST)
     *
     * @return  self
     */ 
    public function withLanguage(string $language)
    {
        $this->language = $language;

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
     * Set format of the message which is displayed on the phone screen. Possible values: GSM-7 (default), UCS-2. Max characters count for GSM-7 and UCS-2 is 40 and 20 characters respectively.
     *
     * @param  string  $messageFormat  Format of the message which is displayed on the phone screen. Possible values: GSM-7 (default), UCS-2. Max characters count for GSM-7 and UCS-2 is 40 and 20 characters respectively.
     *
     * @return  self
     */ 
    public function withMessageFormat(string $messageFormat)
    {
        $this->messageFormat = $messageFormat;

        return $this;
    }

    /**
     * Set pEP's check
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
        
        $this->validateParameters(['phone', 'code']);
        
        $request = new Request();
        $request->setApiName(Request::API_NAME_MOBILE_ID_INIT_AUTH);
        
        $request->setBodyParameters($this->bodyParams);

        return $request;
    }
}