<?php


namespace AppBundle\GatewaySDKPhp;


use AppBundle\GatewaySDKPhp\ConnectorDoc AS Connector;
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
    private $apiKey;

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
     * @param string $apiKey
     * @param LoggerInterface $logger
     */
    public function __construct(string $apiKey, LoggerInterface $logger, string $locale = 'lt')
    {
        $this->apiKey = $apiKey;
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
        $requestBuilder->withApiKey($this->apiKey);
    }
}