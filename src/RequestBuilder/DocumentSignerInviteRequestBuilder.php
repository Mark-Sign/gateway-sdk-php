<?php


namespace AppBundle\GatewaySDKPhp\RequestBuilder;

use AppBundle\GatewaySDKPhp\Model\Request;
use AppBundle\GatewaySDKPhp\Model\RequestInterface;
use AppBundle\GatewaySDKPhp\RequestBuilder\Partials\Signer;
use AppBundle\GatewaySDKPhp\RequestBuilder\Traits\TraitBuildParameters;
use AppBundle\GatewaySDKPhp\RequestBuilder\Annotations\RequestParameter;

class DocumentSignerInviteRequestBuilder extends AbstractRequestBuilder
{
    use TraitBuildParameters;

    /**
     * @var string
     * @RequestParameter(name = "documentId")
     */
    protected $documentId;

    /**
     * @var Signer
     * @RequestParameter(name = "signer")
     */
    protected $signer;

    /**
     * Builds the request object
     *
     * @return RequestInterface
     */
    public function createRequest(): RequestInterface
    {
        $this->bodyParams = $this->buildParameters();
        
        $request = new Request();
        $request->setApiName(Request::API_NAME_DOCUMENT_SIGNER_INVITE);
        
        $request->setBodyParameters($this->bodyParams);

        return $request;
    }

    /**
     * @param string $documentId
     * @return self
     */
    public function withDocumentId(string $documentId): self
    {
        $this->documentId = $documentId;

        return $this;
    }

    /**
     * @param Signer $signer
     * @return self
     */
    public function withSigner(Signer $signer): self
    {
        $this->signer = $signer;

        return $this;
    }

}