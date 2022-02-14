<?php


namespace AppBundle\GatewaySDKPhp\Model;


use Symfony\Contracts\HttpClient\ResponseInterface as BaseResponseInterfaceAlias;

class Response implements ResponseInterface
{
    /**
     * @var BaseResponseInterfaceAlias
     */
    private $response;

    /**
     * Response constructor.
     * @param BaseResponseInterfaceAlias $response
     */
    public function __construct(BaseResponseInterfaceAlias $response)
    {
        $this->response = $response;
    }

    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

    public function getContent(): string
    {
        return $this->response->getContent(false);
    }

    public function toArray(): array
    {
        return $this->response->toArray(false);
    }

    public function getHeaders(): array
    {
        return $this->response->getHeaders(false);
    }

    public function getHeader(string $headerName): ?string
    {
        $headers = $this->getHeaders();
        $headerName = strtolower($headerName);
        return (isset($headers[$headerName]) && isset($headers[$headerName][0])) ? $headers[$headerName][0] . '' : null;
    }
}