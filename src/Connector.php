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

    private const API_PATH_DOCUMENT_UPLOAD = '/api/document/upload.json';
    private const API_PATH_DOCUMENT_VALIDATION = '/api/v2/document/{documentId}/validation.json';
    private const API_PATH_DOCUMENT_FILE_VALIDATION = '/api/v2/document/validation.json';
    private const API_PATH_DOCUMENT_SIGNER_INVITE = '/api/document/{documentId}/invite-signer.json';
    private const API_PATH_DOCUMENT_STATUS_CHECK = '/api/document/{documentId}/check-status.json';
    private const API_PATH_DOCUMENT_DOWNLOAD = '/api/document/{documentId}/download.json';
    private const API_PATH_DOCUMENT_REMOVE = '/api/document/{documentId}/remove.json';

    private const API_PATH_MOBILE_ID_INIT_AUTH = '/mobile/login.json';
    private const API_PATH_MOBILE_ID_IDENTIFICATION_SESSION_STATUS = '/mobile/status/{token}.json';
    private const API_PATH_MOBILE_ID_INIT_SIGNING = '/mobile/sign.json';
    private const API_PATH_MOBILE_ID_SIGNING_STATUS = '/mobile/sign/status/{token}.json';
    private const API_PATH_MOBILE_ID_INIT_HASH_SIGNING = '/mobile/sign/hash.json';
    private const API_PATH_MOBILE_ID_HASH_SIGNING_STATUS = '/mobile/sign-hash/status/{token}.json';
    private const API_PATH_MOBILE_ID_IDENTIFICATION_REMOVE = '/api/mobile/session/{sessionId}';

    private const API_PATH_SMART_ID_INIT_AUTH = '/smartid/login.json';
    private const API_PATH_SMART_ID_IDENTIFICATION_SESSION_STATUS = '/smartid/status/{token}.json';
    private const API_PATH_SMART_ID_INIT_SIGNING = '/smartid/sign.json';
    private const API_PATH_SMART_ID_SIGNING_STATUS = '/smartid/sign/status/{token}.json';
    private const API_PATH_SMART_ID_INIT_HASH_SIGNING = '/smartid/sign/hash.json';
    private const API_PATH_SMART_ID_HASH_SIGNING_STATUS = '/smartid/sign/hash/status/{token}.json';
    private const API_PATH_SMART_ID_IDENTIFICATION_REMOVE = '/api/smartid/session/{sessionId}';

    private const API_PATH_IFRAME_TEMP_SIGNING_LINK_GENERATION = '/api/document/generate-temporary-signing-link.json';
    private const API_PATH_IFRAME_DOC_SIGNER_LIST_GENERATION = '/api/document/{documentId}/signers.json';
    private const API_PATH_IFRAME_REMOVE_DOCUMENT_SIGNER = '/api/document/{documentId}/remove-temporary-signer.json';

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
        $this->apiUrl = "https://api.marksign.eu";
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
            case RequestInterface::API_NAME_MOBILE_ID_INIT_AUTH:
                return $this->postMobileidInitAuthRequest($request);
            case RequestInterface::API_NAME_MOBILE_ID_IDENTIFICATION_SESSION_STATUS:
                return $this->postMobileidIdentificationSessionStatusRequest($request);
            case RequestInterface::API_NAME_MOBILE_ID_INIT_SIGNING:
                return $this->postMobileidInitSignRequest($request);
            case RequestInterface::API_NAME_MOBILE_ID_SIGNING_STATUS:
                return $this->postMobileidSigningStatusRequest($request);
            case RequestInterface::API_NAME_MOBILE_ID_INIT_HASH_SIGNING:
                return $this->postMobileidInitHashSignRequest($request);
            case RequestInterface::API_NAME_MOBILE_ID_HASH_SIGNING_STATUS:
                return $this->postMobileidHashSigningStatusRequest($request);
            case RequestInterface::API_NAME_MOBILE_ID_IDENTIFICATION_REMOVE:
                return $this->deleteMobileidIdentificationSessionRequest($request);
            case RequestInterface::API_NAME_SMART_ID_INIT_AUTH:
                return $this->postSmartidInitAuthRequest($request);
            case RequestInterface::API_NAME_SMART_ID_IDENTIFICATION_SESSION_STATUS:
                return $this->postSmartidIdentificationSessionStatusRequest($request);
            case RequestInterface::API_NAME_SMART_ID_INIT_SIGNING:
                return $this->postSmartidInitSignRequest($request);
            case RequestInterface::API_NAME_SMART_ID_SIGNING_STATUS:
                return $this->postSmartidSigningStatusRequest($request);
            case RequestInterface::API_NAME_SMART_ID_INIT_HASH_SIGNING:
                return $this->postSmartidInitHashSignRequest($request);
            case RequestInterface::API_NAME_SMART_ID_HASH_SIGNING_STATUS:
                return $this->postSmartidHashSigningStatusRequest($request);
            case RequestInterface::API_NAME_SMART_ID_IDENTIFICATION_REMOVE:
                return $this->deleteSmartidIdentificationSessionRequest($request);
            case RequestInterface::API_NAME_IFRAME_TEMP_SIGNING_LINK_GENERATION:
                return $this->postIframeTempSigningLinkGenerationRequest($request);
            case RequestInterface::API_NAME_IFRAME_DOCUMENT_SIGNER_LIST_GENERATION:
                return $this->postIframeDocSignerListGenerationRequest($request);
            case RequestInterface::API_NAME_IFRAME_DOCUMENT_SIGNER_REMOVE:
                return $this->postIframeRemoveDocumentSignerRequest($request);
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
            ($this->locale != 'lt' ? '/en' : '') . self::API_PATH_SIGN_DOCUMENT_SMART_ID,
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
            ($this->locale != 'lt' ? '/en' : '') . self::API_PATH_SIGN_DOCUMENT_MOBILE_ID,
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
            ($this->locale != 'lt' ? '/en' : '') . self::API_PATH_DOCUMENT_UPLOAD,
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
            ($this->locale != 'lt' ? '/en' : '') . $this->replaceURLParameters(self::API_PATH_DOCUMENT_VALIDATION, $request),
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
            ($this->locale != 'lt' ? '/en' : '') . $this->replaceURLParameters(self::API_PATH_DOCUMENT_FILE_VALIDATION, $request),
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
            ($this->locale != 'lt' ? '/en' : '') . $this->replaceURLParameters(self::API_PATH_DOCUMENT_SIGNER_INVITE, $request),
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
            ($this->locale != 'lt' ? '/en' : '') . $this->replaceURLParameters(self::API_PATH_DOCUMENT_STATUS_CHECK, $request),
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
            ($this->locale != 'lt' ? '/en' : '') . $this->replaceURLParameters(self::API_PATH_DOCUMENT_DOWNLOAD, $request),
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
            ($this->locale != 'lt' ? '/en' : '') . $this->replaceURLParameters(self::API_PATH_DOCUMENT_REMOVE, $request),
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
    public function postMobileidInitAuthRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->postClientRequest(
            'POST',
            ($this->locale != 'lt' ? '/en' : '') . $this->replaceURLParameters(self::API_PATH_MOBILE_ID_INIT_AUTH, $request),
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
    public function postMobileidIdentificationSessionStatusRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->postClientRequest(
            'POST',
            ($this->locale != 'lt' ? '/en' : '') . $this->replaceURLParameters(self::API_PATH_MOBILE_ID_IDENTIFICATION_SESSION_STATUS, $request),
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
    public function postMobileidInitSignRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->postClientRequest(
            'POST',
            ($this->locale != 'lt' ? '/en' : '') . $this->replaceURLParameters(self::API_PATH_MOBILE_ID_INIT_SIGNING, $request),
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
    public function postMobileidSigningStatusRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->postClientRequest(
            'POST',
            ($this->locale != 'lt' ? '/en' : '') . $this->replaceURLParameters(self::API_PATH_MOBILE_ID_SIGNING_STATUS, $request),
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
    public function postMobileidInitHashSignRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->postClientRequest(
            'POST',
            ($this->locale != 'lt' ? '/en' : '') . $this->replaceURLParameters(self::API_PATH_MOBILE_ID_INIT_HASH_SIGNING, $request),
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
    public function postMobileidHashSigningStatusRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->postClientRequest(
            'POST',
            ($this->locale != 'lt' ? '/en' : '') . $this->replaceURLParameters(self::API_PATH_MOBILE_ID_HASH_SIGNING_STATUS, $request),
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
    public function deleteMobileidIdentificationSessionRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->postClientRequest(
            'DELETE',
            ($this->locale != 'lt' ? '/en' : '') . $this->replaceURLParameters(self::API_PATH_MOBILE_ID_IDENTIFICATION_REMOVE, $request),
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
    public function postSmartidInitAuthRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->postClientRequest(
            'POST',
            ($this->locale != 'lt' ? '/en' : '') . $this->replaceURLParameters(self::API_PATH_SMART_ID_INIT_AUTH, $request),
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
    public function postSmartidIdentificationSessionStatusRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->postClientRequest(
            'POST',
            ($this->locale != 'lt' ? '/en' : '') . $this->replaceURLParameters(self::API_PATH_SMART_ID_IDENTIFICATION_SESSION_STATUS, $request),
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
    public function postSmartidInitSignRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->postClientRequest(
            'POST',
            ($this->locale != 'lt' ? '/en' : '') . $this->replaceURLParameters(self::API_PATH_SMART_ID_INIT_SIGNING, $request),
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
    public function postSmartidSigningStatusRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->postClientRequest(
            'POST',
            ($this->locale != 'lt' ? '/en' : '') . $this->replaceURLParameters(self::API_PATH_SMART_ID_SIGNING_STATUS, $request),
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
    public function postSmartidInitHashSignRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->postClientRequest(
            'POST',
            ($this->locale != 'lt' ? '/en' : '') . $this->replaceURLParameters(self::API_PATH_SMART_ID_INIT_HASH_SIGNING, $request),
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
    public function postSmartidHashSigningStatusRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->postClientRequest(
            'POST',
            ($this->locale != 'lt' ? '/en' : '') . $this->replaceURLParameters(self::API_PATH_SMART_ID_HASH_SIGNING_STATUS, $request),
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
    public function deleteSmartidIdentificationSessionRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->postClientRequest(
            'DELETE',
            ($this->locale != 'lt' ? '/en' : '') . $this->replaceURLParameters(self::API_PATH_SMART_ID_IDENTIFICATION_REMOVE, $request),
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
    public function postIframeTempSigningLinkGenerationRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->postClientRequest(
            'POST',
            self::API_PATH_IFRAME_TEMP_SIGNING_LINK_GENERATION,
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
    public function postIframeDocSignerListGenerationRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->postClientRequest(
            'POST',
            $this->replaceURLParameters(self::API_PATH_IFRAME_DOC_SIGNER_LIST_GENERATION, $request),
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
    public function postIframeRemoveDocumentSignerRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->postClientRequest(
            'POST',
            $this->replaceURLParameters(self::API_PATH_IFRAME_REMOVE_DOCUMENT_SIGNER, $request),
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
        $options['timeout'] = 240;
        
        $url = $this->apiUrl . $apiPath;

        $this->logger->debug("Making request: $method $url", $options);

        try {
            $response = $this->client->request($method, $url, $options);
            $statusCode = $response->getStatusCode();

            // Determine Content-Type
            $headers = $response->getHeaders(false);
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