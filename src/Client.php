<?php


namespace AppBundle\GatewaySDKPhp;


use AppBundle\GatewaySDKPhp\Connector;
use AppBundle\GatewaySDKPhp\ConnectorInterface;
use AppBundle\GatewaySDKPhp\Model\RequestInterface;
use AppBundle\GatewaySDKPhp\Model\ResponseInterface;
use AppBundle\GatewaySDKPhp\RequestBuilder\RequestBuilderInterface;
use AppBundle\GatewaySDKPhp\RequestBuilder\SignDocumentSmartIdRequestBuilder;
use Psr\Log\LoggerInterface;

class Client
{
    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var ConnectorInterface
     */
    private $connector;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Client constructor.
     * @param string $accessToken
     * @param LoggerInterface $logger
     */
    public function __construct(string $accessToken, LoggerInterface $logger, string $locale = 'lt')
    {
        $this->accessToken = $accessToken;
        $this->logger = $logger;
        $this->locale = $locale;
    }

    /**
     * @param string $apiName
     * @return RequestBuilderInterface
     */
    public function getRequestBuilder(string $apiName)
    {
        switch ($apiName) {
            case RequestInterface::API_NAME_SIGN_DOCUMENT_SMART_ID:
                $requestBuilder = new SignDocumentSmartIdRequestBuilder();
                break;
            default:
                throw new \InvalidArgumentException('Invalid apiName argument provided');
        }

        $this->hydrateRequestBuilder($requestBuilder);

        return $requestBuilder;
    }

    /**
     * @return SignDocumentSmartIdRequestBuilder
     */
    public function getSignDocumentSmartIdRequestBuilder(): SignDocumentSmartIdRequestBuilder
    {
        return $this->getRequestBuilder(RequestInterface::API_NAME_SIGN_DOCUMENT_SMART_ID);
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function postRequest(RequestInterface $request)
    {
        // Cannot use hydrateRequestBuilder() because the parameters are already generated in implementations of RequestBuilderInterface::createRequest()
        // If we use hydrateRequestBuilder(), we have to rebuild the parameters, and building parameters multiple times might be costly
        $request->setBodyParameters(array_merge(['access_token' => $this->accessToken], $request->getBodyParameters()));
        return $this->getConnector()->postRequest($request);
    }

    /**
     * @return ConnectorInterface
     */
    private function getConnector(): ConnectorInterface
    {
        if (!isset($this->connector)) {
            $this->connector = new Connector($this->logger, $this->locale);
        }

        return $this->connector;
    }

    /**
     * @param RequestBuilderInterface $requestBuilder
     */
    private function hydrateRequestBuilder(RequestBuilderInterface $requestBuilder)
    {
        $requestBuilder->withAccessToken($this->accessToken);
    }
}