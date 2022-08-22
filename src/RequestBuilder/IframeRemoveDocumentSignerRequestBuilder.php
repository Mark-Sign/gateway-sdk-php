<?php


namespace AppBundle\GatewaySDKPhp\RequestBuilder;

use AppBundle\GatewaySDKPhp\Model\Request;
use AppBundle\GatewaySDKPhp\Model\RequestInterface;
use AppBundle\GatewaySDKPhp\RequestBuilder\Partials\FileUpload;
use AppBundle\GatewaySDKPhp\RequestBuilder\Partials\Signer;
use AppBundle\GatewaySDKPhp\RequestBuilder\Traits\TraitBuildParameters;
use AppBundle\GatewaySDKPhp\RequestBuilder\Annotations\RequestParameter;
use AppBundle\GatewaySDKPhp\RequestBuilder\Partials\Files;

class IframeRemoveDocumentSignerRequestBuilder extends AbstractRequestBuilder
{
    use TraitBuildParameters;

    /**
     * Document ID
     *
     * @var string
     * @RequestParameter(name = "documentId")
     */
    protected $documentId;

    /**
     * Signer's name
     *
     * @var string
     * @RequestParameter(name = "name")
     */
    protected $name;

    /**
     * Signer's surname
     *
     * @var string
     * @RequestParameter(name = "surname")
     */
    protected $surname;

    /**
     * Signer's email
     *
     * @var string
     * @RequestParameter(name = "email")
     */
    protected $email;

    /**
     * Signer's personal code
     *
     * @var string
     * @RequestParameter(name = "personal_code")
     */
    protected $personalCode;

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
     * @param string $name
     * @return self
     */
    public function withName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $surname
     * @return self
     */
    public function withSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @param string $email
     * @return self
     */
    public function withEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param string $personalCode
     * @return self
     */
    public function withPersonalCode(string $personalCode): self
    {
        $this->accessToken = $personalCode;

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
        $this->validateParameters(['documentId']);
        
        $request = new Request();
        $request->setApiName(Request::API_NAME_IFRAME_REMOVE_DOCUMENT_SIGNER_GENERATION);
        
        $request->setBodyParameters($this->bodyParams);

        return $request;
    }

}