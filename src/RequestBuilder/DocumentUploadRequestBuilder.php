<?php


namespace AppBundle\GatewaySDKPhp\RequestBuilder;


use AppBundle\GatewaySDKPhp\Exception\MissingParameterException;
use AppBundle\GatewaySDKPhp\Model\Request;
use AppBundle\GatewaySDKPhp\Model\RequestInterface;
use AppBundle\GatewaySDKPhp\RequestBuilder\Partials\FileUpload;
use AppBundle\GatewaySDKPhp\RequestBuilder\Partials\Signer;
use AppBundle\GatewaySDKPhp\RequestBuilder\Traits\TraitBuildParameters;
use AppBundle\GatewaySDKPhp\RequestBuilder\Annotations\RequestParameter;

class DocumentUploadRequestBuilder extends AbstractRequestBuilder
{
    use TraitBuildParameters;

    /**
     * @var string
     * @RequestParameter(name = "access_token")
     */
    protected $accessToken;

    /**
     * @var string
     * @RequestParameter(name = "access")
     */
    protected $access;

    /**
     * @var FileUpload
     * @RequestParameter(name = "file")
     */
    protected $file;

    /**
     * @var Signer[]
     * @RequestParameter(name = "signers")
     */
    protected $signers;

    /**
     * Builds the request object
     *
     * @return RequestInterface
     */
    public function createRequest(): RequestInterface
    {
        $this->bodyParams = $this->buildParameters();
        
        $this->validateParameters(['access_token', 'access', 'file', 'signers']);
        
        $request = new Request();
        $request->setApiName(Request::API_NAME_DOCUMENT_UPLOAD);
        
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
     * @param string $access
     * @return self
     */
    public function withAccess(string $access): self
    {
        $this->access = $access;

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
     * @param Signer[] $signers
     * @return self
     */
    public function withSigners(array $signers): self
    {
        $this->signers = $signers;

        return $this;
    }

}