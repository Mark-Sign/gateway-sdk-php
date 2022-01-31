<?php


namespace AppBundle\GatewaySDKPhp\RequestBuilder;


use AppBundle\GatewaySDKPhp\Exception\MissingParameterException;
use AppBundle\GatewaySDKPhp\Model\Request;
use AppBundle\GatewaySDKPhp\Model\RequestInterface;
use AppBundle\GatewaySDKPhp\RequestBuilder\Partials\FileUpload;
use AppBundle\GatewaySDKPhp\RequestBuilder\Partials\Signer;
use AppBundle\GatewaySDKPhp\RequestBuilder\Traits\TraitBuildParameters;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints AS Assert;

class DocumentValidationRequestBuilder extends AbstractRequestBuilder
{
    use TraitBuildParameters;

    /**
     * @var string
     */
    protected $access_token;

    /**
     * @var string
     */
    protected $documentId;

    public function createRequest(): RequestInterface
    {
        $bodyParams = $this->buildParameters();
        
        // Here, we can pass $bodyParams to $this->validateParameters()
        // to validate if all the required parameters have been set or not.
        // We can use any validator that seems suitable
        $this->validateParameters();
        
        $request = new Request();
        $request->setApiName(Request::API_NAME_DOCUMENT_VALIDATION);
        
        $request->setBodyParameters($bodyParams);

        return $request;
    }

    /**
     * @param string $access_token
     * @return self
     */
    public function withAccessToken(string $access_token): self
    {
        $this->access_token = $access_token;

        return $this;
    }

    /**
     * @param string $access
     * @return self
     */
    public function withDocumentId(string $documentId): self
    {
        $this->documentId = $documentId;

        return $this;
    }

    /**
     * @throws MissingParameterException
     */
    private function validateParameters()
    {
        $requiredParams = ['access_token', 'documentId'];

        foreach ($requiredParams as $param) {
            if (!isset($this->$param)) {
                throw new MissingParameterException("Missing required request parameter '{$param}'");
            }
        }
    }
}