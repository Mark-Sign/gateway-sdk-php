<?php


namespace AppBundle\GatewaySDKPhp\Model;


class Request implements RequestInterface
{
    /**
     * @var string
     */
    private $apiName;

    /**
     * @var array
     */
    private $body = [];

    /**
     * @param string $apiName
     * @return $this
     */
    public function setApiName(string $apiName): self
    {
        $this->apiName = $apiName;

        return $this;
    }

    public function getApiName(): string
    {
        return $this->apiName;
    }

    public function setBodyParameters(array $params): RequestInterface
    {
        $this->body = $params;

        return $this;
    }

    public function getBodyParameters(): array
    {
        return $this->body;
    }
}