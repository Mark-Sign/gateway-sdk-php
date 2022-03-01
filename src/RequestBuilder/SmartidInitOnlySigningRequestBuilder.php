<?php


namespace AppBundle\GatewaySDKPhp\RequestBuilder;

use AppBundle\GatewaySDKPhp\Model\Request;
use AppBundle\GatewaySDKPhp\Model\RequestInterface;
use AppBundle\GatewaySDKPhp\RequestBuilder\Traits\TraitBuildParameters;
use AppBundle\GatewaySDKPhp\RequestBuilder\Annotations\RequestParameter;
use AppBundle\GatewaySDKPhp\RequestBuilder\Partials\Files;

class SmartidInitOnlySigningRequestBuilder extends AbstractRequestBuilder
{
    use TraitBuildParameters;

    /**
     * Document format. Possible values: pdf, adoc, bdoc, asice.
     * 
     * @var string
     * @RequestParameter(name = "type")
     */
    protected $type;

    /**
     * Signer country code: LT, LV, EE
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
     * Requested SK Smart-ID certificate level. Possible values: QSCD, QUALIFIED. Defaults to QSCD
     * 
     * @var string
     * @RequestParameter(name = "certificate_level")
     */
    protected $certificateLevel;

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
     * Set adoc files
     * 
     * @var Files
     * @RequestParameter(name = "adoc")
     */
    protected $adoc;

    /**
     * Set asice files
     * 
     * @var Files
     * @RequestParameter(name = "asice")
     */
    protected $asice;

    /**
     * Set bdoc files
     * 
     * @var Files
     * @RequestParameter(name = "bdoc")
     */
    protected $bdoc;

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
     * Set signer country code: LT, LV, EE
     *
     * @param  string  $country  Signer country code: LT, LV, EE
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
     * Set requested SK Smart-ID certificate level. Possible values: QSCD, QUALIFIED. Defaults to QSCD
     *
     * @param  string  $certificateLevel  Requested SK Smart-ID certificate level. Possible values: QSCD, QUALIFIED. Defaults to QSCD
     *
     * @return  self
     */ 
    public function withCertificateLevel(string $certificateLevel)
    {
        $this->certificateLevel = $certificateLevel;

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

    /**
     * Builds the request object
     *
     * @return RequestInterface
     */
    public function createRequest(): RequestInterface
    {
        $this->bodyParams = $this->buildParameters();
        
        $this->validateParameters(['type', 'country', 'code']);
        
        $request = new Request();
        $request->setApiName(Request::API_NAME_SMART_ID_INIT_ONLY_SIGNING);
        
        $request->setBodyParameters($this->bodyParams);

        return $request;
    }
}