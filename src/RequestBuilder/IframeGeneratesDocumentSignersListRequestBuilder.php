<?php


namespace AppBundle\GatewaySDKPhp\RequestBuilder;

use AppBundle\GatewaySDKPhp\Model\Request;
use AppBundle\GatewaySDKPhp\Model\RequestInterface;
use AppBundle\GatewaySDKPhp\RequestBuilder\Partials\FileUpload;
use AppBundle\GatewaySDKPhp\RequestBuilder\Partials\Signer;
use AppBundle\GatewaySDKPhp\RequestBuilder\Traits\TraitBuildParameters;
use AppBundle\GatewaySDKPhp\RequestBuilder\Annotations\RequestParameter;
use AppBundle\GatewaySDKPhp\RequestBuilder\Partials\Files;

class IframeGeneratesDocumentSignersListRequestBuilder extends AbstractRequestBuilder
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
     * Builds the request object
     *
     * @return RequestInterface
     */
    public function createRequest(): RequestInterface
    {
        $this->bodyParams = $this->buildParameters();
        $this->validateParameters(['documentId']);

        $request = new Request();
        $request->setApiName(Request::API_NAME_IFRAME_DOCUMENT_SIGNER_LIST_GENERATION);
        
        $request->setBodyParameters($this->bodyParams);

        return $request;
    }

}