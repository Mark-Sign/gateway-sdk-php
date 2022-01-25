<?php

namespace AppBundle\GatewaySDKPhp;


use AppBundle\GatewaySDKPhp\src\Exception\ApiException;
use AppBundle\GatewaySDKPhp\src\Exception\RequestException;
use AppBundle\GatewaySDKPhp\src\Model\RequestInterface;
use AppBundle\GatewaySDKPhp\src\Model\Response;
use AppBundle\GatewaySDKPhp\src\Model\ResponseInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpClient\HttpClient;

class Connector implements ConnectorInterface
{
    private const API_PATH_SIGN_DOCUMENT_SMART_ID = '/smartid/sign.json';
    private const API_PATH_SIGN_DOCUMENT_MOBILE_ID = '/mobileid/sign.json';

    /**
     * @var string
     */
    private $apiUrl;

    /**
     * @var HttpClient
     */
    private $client;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Connector constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->apiUrl = "https://www.markid.lt";
        $this->client = HttpClient::create();
        $this->logger = $logger;
    }

    public function postRequest(RequestInterface $request): ResponseInterface
    {
        switch($request->getApiName()) {
            case RequestInterface::API_NAME_SIGN_DOCUMENT_SMART_ID:
                return $this->postSignDocumentSmartIdRequest($request);
            case RequestInterface::API_NAME_SIGN_DOCUMENT_MOBILE_ID:
                return $this->postSignDocumentMobileIdRequest($request);
            default:
                throw new \InvalidArgumentException('Invalid request provided');
        }
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function postSignDocumentSmartIdRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->postClientRequest(
            'POST',
            self::API_PATH_SIGN_DOCUMENT_SMART_ID,
            [
                'json' => $request->getBodyParameters(),
            ]
        );

        return new Response($response);
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function postSignDocumentMobileIdRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->postClientRequest(
            'POST',
            self::API_PATH_SIGN_DOCUMENT_MOBILE_ID,
            [
                'json' => $request->getBodyParameters(),
            ]
        );

        return new Response($response);
    }

    /**
     * @param string $method
     * @param string $apiPath
     * @param array $options
     * @return \Symfony\Contracts\HttpClient\ResponseInterface
     * @throws RequestException
     * @throws ApiException
     */
    private function postClientRequest(string $method, string $apiPath, array $options = []): \Symfony\Contracts\HttpClient\ResponseInterface
    {
        $url = $this->apiUrl . $apiPath;

        $this->logger->debug("Making request: $method $url", $options);

        try {
            $response = $this->client->request($method, $url, $options);
            $statusCode = $response->getStatusCode();
            $content = $response->toArray(false);
        } catch (\Throwable $e) {
            throw new RequestException('Request was not successful', 0, $e);
        }

        $this->logger->debug("Returned response {$statusCode}", $content);

        if ($statusCode !== 200) {
            throw new ApiException("Unexpected response status code '{$statusCode}'", $statusCode);
        } elseif (!isset($content['result'])) {
            throw new ApiException('Response result object is missing');
        }

        $result = $content['result'];
        $resultStatusCode = $result['status_code'] ?? null;
        $resultError = $result['error'] ?? null;

        if ($resultStatusCode !== 200 && $resultError) {
            throw new ApiException($resultError, $resultStatusCode);
        }

        return $response;
    }
}