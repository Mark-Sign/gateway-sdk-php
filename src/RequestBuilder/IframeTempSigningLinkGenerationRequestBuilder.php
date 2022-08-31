<?php


namespace AppBundle\GatewaySDKPhp\RequestBuilder;

use AppBundle\GatewaySDKPhp\Model\Request;
use AppBundle\GatewaySDKPhp\Model\RequestInterface;
use AppBundle\GatewaySDKPhp\RequestBuilder\Partials\FileUpload;
use AppBundle\GatewaySDKPhp\RequestBuilder\Partials\Signer;
use AppBundle\GatewaySDKPhp\RequestBuilder\Traits\TraitBuildParameters;
use AppBundle\GatewaySDKPhp\RequestBuilder\Annotations\RequestParameter;
use AppBundle\GatewaySDKPhp\RequestBuilder\Partials\Files;

class IframeTempSigningLinkGenerationRequestBuilder extends AbstractRequestBuilder
{
    use TraitBuildParameters;

    /**
     * Document ID
     * 
     * @var string
     * @RequestParameter(name = "document_id")
     */
    protected $documentId;

    /**
     * @var FileUpload
     * @RequestParameter(name = "file")
     */
    protected $file;

    /**
     * Callback URL
     * 
     * @var string
     * @RequestParameter(name = "callback_url")
     */
    protected $callbackUrl;

    /**
     * Expiration period in minutes (default value is 30)
     * 
     * @var integer
     * @RequestParameter(name = "expire_after")
     */
    protected $expireAfter;

    /**
     * Document removal period in minutes (should not be less than expire_after value)
     * 
     * @var integer
     * @RequestParameter(name = "delete_document_after")
     */
    protected $deleteDocumentAfter;

    /**
     * @var Signer[]
     * @RequestParameter(name = "signers")
     */
    protected $signers;

    /**
     * User interface language ('lt' or 'en')
     *
     * @var string
     * @RequestParameter(name = "language")
     */
    protected $language;

    /**
     * Set Document ID
     *
     * @param  string $documentId
     * @return  self
     */
    public function withDocumentId(string $documentId)
    {
        $this->documentId = $documentId;

        return $this;
    }

    /**
     * @param FileUpload $file
     * @return self
     */
    public function withFile(FileUpload $file): self
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Set callback url
     *
     * @param string  $callbackUrl
     * @return self
     */ 
    public function withCallbackUrl(string $callbackUrl)
    {
        $this->callbackUrl = $callbackUrl;

        return $this;
    }

    /**
     * Set expires after
     *
     * @param int $expireAfter
     * @return self
     */ 
    public function withExpireAfter(int $expireAfter)
    {
        $this->expireAfter = $expireAfter;

        return $this;
    }

    /**
     * Set Document removal period in minutes
     *
     * @param int $deleteDocumentAfter
     * @return self
     */
    public function withDeleteDocumentAfter(int $deleteDocumentAfter)
    {
        $this->deleteDocumentAfter = $deleteDocumentAfter;

        return $this;
    }

    /**
     * @param Signer[] $signers
     * @return self
     */
    public function withSigners(array $signers): self
    {
        $this->signers = $signers;

        return $this;
    }

    /**
     * Set user interface language
     *
     * @param string  $language
     * @return self
     */
    public function withLanguage(string $language)
    {
        $this->language = $language;

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
        $this->validateParameters(['callback_url']);
        
        $request = new Request();
        $request->setApiName(Request::API_NAME_IFRAME_TEMP_SIGNING_LINK_GENERATION);
        
        $request->setBodyParameters($this->bodyParams);

        return $request;
    }

}