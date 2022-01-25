<?php


namespace AppBundle\GatewaySDKPhp\src\RequestBuilder;


use AppBundle\GatewaySDKPhp\src\Exception\MissingParameterException;
use AppBundle\GatewaySDKPhp\src\Model\Request;
use AppBundle\GatewaySDKPhp\src\Model\RequestInterface;

class SignDocumentSmartIdRequestBuilder extends AbstractRequestBuilder
{
    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string|null
     */
    private $message;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string|null
     */
    private $signaturePosition;

    /**
     * @var string|null
     */
    private $signaturePage;

    /**
     * @var boolean
     */
    private $peps;

    /**
     * @var boolean
     */
    private $sanctions;

    /**
     * @var array $files
     */
    private $files;

    public function createRequest(): RequestInterface
    {
        $this->validateParameters();

        $request = new Request();
        $request->setApiName(Request::API_NAME_SIGN_DOCUMENT_SMART_ID);

        $bodyParams = [
            'accessToken' => $this->accessToken,
            'type' => $this->type,
            'country' => $this->country,
            'code' => $this->code,
            'files' => $this->files,
        ];

        $optionalParameters = [
            'message' => $this->message ?? null,
            'signature_position' => $this->signaturePosition ?? null,
            'signaturePage' => $this->signaturePage ?? null,
            'peps' => $this->peps ?? false,
            'sanctions' => $this->sanctions ?? false,
        ];

        foreach ($optionalParameters as $param => $value) {
            if (isset($value)) {
                $bodyParams[$param] = $value;
            }
        }

        $request->setBodyParameters($bodyParams);

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
     * @param string $type
     * @return self
     */
    public function withType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param string $country
     * @return self
     */
    public function withCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @param string|null $message
     * @return self
     */
    public function withMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param string $code
     * @return self
     */
    public function withCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @param string|null $signaturePosition
     * @return self
     */
    public function withSignaturePosition(?string $signaturePosition): self
    {
        $this->signaturePosition = $signaturePosition;

        return $this;
    }

    /**
     * @param string|null $signaturePage
     * @return self
     */
    public function withSignaturePage(?string $signaturePage): self
    {
        $this->signaturePage = $signaturePage;

        return $this;
    }

    /**
     * @param bool|null $peps
     * @return self
     */
    public function withPeps(?bool $peps): self
    {
        $this->peps = $peps;

        return $this;
    }

    /**
     * @param bool|null $sanctions
     * @return self
     */
    public function withSanctions(?bool $sanctions): self
    {
        $this->sanctions = $sanctions;

        return $this;
    }

    /**
     * @param array $files
     * @return self
     */
    public function withFiles(array $files): self
    {
        // TODO add name, content and digest to a file

        return $this;
    }

    /**
     * @throws MissingParameterException
     */
    private function validateParameters()
    {
        $requiredParams = ['accessToken', 'type', 'country', 'code', 'files'];

        foreach ($requiredParams as $param) {
            if (!isset($this->$param)) {
                throw new MissingParameterException("Missing required request parameter '{$param}'");
            }
        }
    }
}