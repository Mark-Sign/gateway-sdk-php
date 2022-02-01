<?php


namespace AppBundle\GatewaySDKPhp\RequestBuilder;

use AppBundle\GatewaySDKPhp\Model\Request;
use AppBundle\GatewaySDKPhp\Model\RequestInterface;
use AppBundle\GatewaySDKPhp\RequestBuilder\Traits\TraitBuildParameters;
use AppBundle\GatewaySDKPhp\RequestBuilder\Annotations\RequestParameter;

class DocumentDownloadRequestBuilder extends AbstractRequestBuilder
{
    use TraitBuildParameters;

    /**
     * @var string
     * @RequestParameter(name = "access_token")
     */
    protected $accessToken;

    /**
     * @var string
     * @RequestParameter(name = "documentId")
     */
    protected $documentId;

    public function createRequest(): RequestInterface
    {
        $this->bodyParams = $this->buildParameters();
        
        $this->validateParameters(['access_token']);
        
        $request = new Request();
        $request->setApiName(Request::API_NAME_DOCUMENT_DOWNLOAD);
        
        $request->setBodyParameters($this->bodyParams);

        return $request;
    }

    /**
     * @param string $accessToken
     * @return self
     */
    public function withAccessToken(string $accessToken): self
    {
        $this->accessToken = $accessToken;

        return $this;
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

}