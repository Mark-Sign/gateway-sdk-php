<?php


namespace AppBundle\GatewaySDKPhp\RequestBuilder;

use AppBundle\GatewaySDKPhp\Model\Request;
use AppBundle\GatewaySDKPhp\Model\RequestInterface;
use AppBundle\GatewaySDKPhp\RequestBuilder\Traits\TraitBuildParameters;
use AppBundle\GatewaySDKPhp\RequestBuilder\Annotations\RequestParameter;
use AppBundle\GatewaySDKPhp\RequestBuilder\Partials\Files;

class MobileidInitSigningRequestBuilder extends AbstractRequestBuilder
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
     * Document format. Possible values: pdf, adoc, bdoc, asice.
     * 
     * @var string
     * @RequestParameter(name = "type")
     */
    protected $type;

    /**
     * Telephone number"
     * 
     * @var string
     * @RequestParameter(name = "phone")
     */
    protected $phone;

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
     * Personal code
     * 
     * @var string
     * @RequestParameter(name = "code")
     */
    protected $code;

    /**
     * Position of a visible signature (pdf annotation) in the pdf document. Possible values: auto, left_top, left_bottom, right_top, right_bottom. Unset value is equal to invisible signature.
     * 
     * @var string
     * @RequestParameter(name = "signature_position")
     */
    protected $signaturePosition;

    /**
     * Page of a visible signature (pdf annotation) in the pdf document. Possible values: first_page, last_page. Unset value is equal to last_page.
     * 
     * @var string
     * @RequestParameter(name = "signature_page")
     */
    protected $signaturePage;

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
     * Set pdf files
     * 
     * @var Files
     * @RequestParameter(name = "pdf")
     */
    protected $pdf;

    /**
     * Set asice files
     * 
     * @var Files
     * @RequestParameter(name = "asice")
     */
    protected $asice;

    /**
     * Set adoc files
     * 
     * @var Files
     * @RequestParameter(name = "adoc")
     */
    protected $adoc;

    /**
     * Set bdoc files
     * 
     * @var Files
     * @RequestParameter(name = "bdoc")
     */
    protected $bdoc;

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
     * Set document format. Possible values: pdf, adoc, bdoc, asice.
     *
     * @param  string  $type  Document format. Possible values: pdf, adoc, bdoc, asice.
     *
     * @return  self
     */ 
    public function withType(string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Set telephone number"
     *
     * @param  string  $phone  Telephone number"
     *
     * @return  self
     */ 
    public function withPhone(string $phone)
    {
        $this->phone = $phone;

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
     * Set position of a visible signature (pdf annotation) in the pdf document. Possible values: auto, left_top, left_bottom, right_top, right_bottom. Unset value is equal to invisible signature.
     *
     * @param  string  $signaturePosition  Position of a visible signature (pdf annotation) in the pdf document. Possible values: auto, left_top, left_bottom, right_top, right_bottom. Unset value is equal to invisible signature.
     *
     * @return  self
     */ 
    public function withSignaturePosition(string $signaturePosition)
    {
        $this->signaturePosition = $signaturePosition;

        return $this;
    }

    /**
     * Set page of a visible signature (pdf annotation) in the pdf document. Possible values: first_page, last_page. Unset value is equal to last_page.
     *
     * @param  string  $signaturePage  Page of a visible signature (pdf annotation) in the pdf document. Possible values: first_page, last_page. Unset value is equal to last_page.
     *
     * @return  self
     */ 
    public function withSignaturePage(string $signaturePage)
    {
        $this->signaturePage = $signaturePage;

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
     * Set set pdf files
     *
     * @param  Files  $pdf  Set pdf files
     *
     * @return  self
     */ 
    public function withPdf(Files $pdf)
    {
        $this->pdf = $pdf;

        return $this;
    }

    /**
     * Set set asice files
     *
     * @param  Files  $asice  Set asice files
     *
     * @return  self
     */ 
    public function withAsice(Files $asice)
    {
        $this->asice = $asice;

        return $this;
    }

    /**
     * Set set adoc files
     *
     * @param  Files  $adoc  Set adoc files
     *
     * @return  self
     */ 
    public function withAdoc(Files $adoc)
    {
        $this->adoc = $adoc;

        return $this;
    }

    /**
     * Set set bdoc files
     *
     * @param  Files  $bdoc  Set bdoc files
     *
     * @return  self
     */ 
    public function withBdoc(Files $bdoc)
    {
        $this->bdoc = $bdoc;

        return $this;
    }

    public function createRequest(): RequestInterface
    {
        $this->bodyParams = $this->buildParameters();
        
        $this->validateParameters(['access_token', 'type', 'phone', 'code']);
        
        $request = new Request();
        $request->setApiName(Request::API_NAME_MOBILE_ID_INIT_SIGNING);
        
        $request->setBodyParameters($this->bodyParams);

        return $request;
    }

}