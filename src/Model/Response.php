<?php


namespace AppBundle\GatewaySDKPhp\src\Model;


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
}