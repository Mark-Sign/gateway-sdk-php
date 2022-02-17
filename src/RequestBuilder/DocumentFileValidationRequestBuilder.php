<?php


namespace AppBundle\GatewaySDKPhp\RequestBuilder;

use AppBundle\GatewaySDKPhp\Model\Request;
use AppBundle\GatewaySDKPhp\Model\RequestInterface;
use AppBundle\GatewaySDKPhp\RequestBuilder\Partials\FileUpload;
use AppBundle\GatewaySDKPhp\RequestBuilder\Traits\TraitBuildParameters;
use AppBundle\GatewaySDKPhp\RequestBuilder\Annotations\RequestParameter;

class DocumentFileValidationRequestBuilder extends AbstractRequestBuilder
{
    use TraitBuildParameters;

    /**
     * @var FileUpload
     * @RequestParameter(name = "file")
     */
    protected $file;

    /**
     * Builds the request object
     *
     * @return RequestInterface
     */
    public function createRequest(): RequestInterface
    {
        $this->bodyParams = $this->buildParameters();
        
        $this->validateParameters(['file']);
        
        $request = new Request();
        $request->setApiName(Request::API_NAME_DOCUMENT_FILE_VALIDATION);
        
        $request->setBodyParameters($this->bodyParams);

        return $request;
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

}