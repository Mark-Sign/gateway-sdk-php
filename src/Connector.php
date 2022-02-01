<?php

namespace AppBundle\GatewaySDKPhp;


use AppBundle\GatewaySDKPhp\Exception\ApiException;
use AppBundle\GatewaySDKPhp\Exception\MissingParameterException;
use AppBundle\GatewaySDKPhp\Exception\RequestException;
use AppBundle\GatewaySDKPhp\Model\RequestInterface;
use AppBundle\GatewaySDKPhp\Model\Response;
use AppBundle\GatewaySDKPhp\Model\ResponseInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpClient\HttpClient;

class Connector implements ConnectorInterface
{
    private const API_PATH_SIGN_DOCUMENT_SMART_ID = '/smartid/sign.json';
    private const API_PATH_SIGN_DOCUMENT_MOBILE_ID = '/mobileid/sign.json';
    private const API_PATH_DOCUMENT_UPLOAD = '/document/upload.json';
    private const API_PATH_DOCUMENT_VALIDATION = '/v2/document/{documentId}/validation.json';
    private const API_PATH_DOCUMENT_FILE_VALIDATION = '/v2/document/validation.json';
    private const API_PATH_DOCUMENT_SIGNER_INVITE = '/document/{documentId}/invite-signer.json';
    private const API_PATH_DOCUMENT_STATUS_CHECK = '/document/{documentId}/check-status.json';
    private const API_PATH_DOCUMENT_DOWNLOAD = '/document/{documentId}/download.json';
    private const API_PATH_DOCUMENT_REMOVE = '/document/{documentId}/remove.json';

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
            case RequestInterface::API_NAME_DOCUMENT_UPLOAD:
                return $this->postDocumentUploadRequest($request);
            case RequestInterface::API_NAME_DOCUMENT_VALIDATION:
                return $this->postDocumentValidationRequest($request);
            case RequestInterface::API_NAME_DOCUMENT_FILE_VALIDATION:
                return $this->postDocumentFileValidationRequest($request);
            case RequestInterface::API_NAME_DOCUMENT_SIGNER_INVITE:
                return $this->postDocumentSignerInviteRequest($request);
            case RequestInterface::API_NAME_DOCUMENT_STATUS_CHECK:
                return $this->getDocumentStatusCheckRequest($request);
            case RequestInterface::API_NAME_DOCUMENT_DOWNLOAD:
                return $this->getDocumentDownloadRequest($request);
            case RequestInterface::API_NAME_DOCUMENT_REMOVE:
                return $this->deleteDocumentRemoveRequest($request);
            default:
                throw new \InvalidArgumentException('Invalid request provided');
        }
    }

    /**
     * Replaces URL parameters from RequestInterface object
     *
     * @param string $url
     * @param RequestInterface $request
     * @return string
     */
    public function replaceURLParameters(string $url, RequestInterface $request): string
    {
        $matches = [];

        $requestBody = $request->getBodyParameters();

        // regex named capture
        preg_match_all('/{(?<match>\w+)}/', $url, $matches);

        foreach ($matches['match'] AS $param) {
            if (!array_key_exists($param, $requestBody)) {
                throw new MissingParameterException("Missing required request parameter '{$param}'");
            }
            $url = str_replace('{' . $param . '}', $requestBody[$param], $url);
        }

        return $url;
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
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function postDocumentUploadRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->postClientRequest(
            'POST',
            self::API_PATH_DOCUMENT_UPLOAD,
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
    public function postDocumentValidationRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->postClientRequest(
            'POST',
            $this->replaceURLParameters(self::API_PATH_DOCUMENT_VALIDATION, $request),
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
    public function postDocumentFileValidationRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->postClientRequest(
            'POST',
            $this->replaceURLParameters(self::API_PATH_DOCUMENT_FILE_VALIDATION, $request),
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
    public function postDocumentSignerInviteRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->postClientRequest(
            'POST',
            $this->replaceURLParameters(self::API_PATH_DOCUMENT_SIGNER_INVITE, $request),
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
    public function getDocumentStatusCheckRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->postClientRequest(
            'GET',
            $this->replaceURLParameters(self::API_PATH_DOCUMENT_STATUS_CHECK, $request),
            [
                'query' => $request->getBodyParameters(),
            ]
        );

        return new Response($response);
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function getDocumentDownloadRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->postClientRequest(
            'GET',
            $this->replaceURLParameters(self::API_PATH_DOCUMENT_DOWNLOAD, $request),
            [
                'query' => $request->getBodyParameters(),
            ]
        );

        return new Response($response);
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function deleteDocumentRemoveRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->postClientRequest(
            'DELETE',
            $this->replaceURLParameters(self::API_PATH_DOCUMENT_REMOVE, $request),
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

            // Determine Content-Type
            $headers = $response->getHeaders();
            $content_type = (isset($headers['content-type']) && isset($headers['content-type'][0])) ? $headers['content-type'][0] : '';
            // If Content-Type is other than application/json, we don't need to convert it to array
            $content = ($content_type == 'application/json') ? $response->toArray(false) : [];
        } catch (\Throwable $e) {
            throw new RequestException('Request was not successful', 0, $e);
        }

        $this->logger->debug("Returned response {$statusCode}, Content-Type {$content_type}", $content);

        if ($statusCode !== 200) {
            $statusMessage = '';
            if (isset($content['error']) && is_array($content['error'])) {
                // This condition matches with symfony error response format
                $statusMessage = $content['error']['message'] ?? '';
            } else if (isset($content['message'])) {
                $statusMessage = $content['message'];
            }

            $message = "Unexpected response status code '{$statusCode}'";
            $message .= strlen($statusMessage) > 0 ? ": '$statusMessage'" : '';
            throw new ApiException($message, $statusCode);
        }

        // If $statusCode is 200, then it means there was no error in the request
        // We can just return the $response
        // Or we can build response for each APIs

        return $response;
    }
}