<?php


namespace AppBundle\GatewaySDKPhp\src\Model;


interface RequestInterface
{
    public const API_NAME_SIGN_DOCUMENT_SMART_ID = 'apiSignDocumentSmartId';
    public const API_NAME_SIGN_DOCUMENT_MOBILE_ID = 'apiSignDocumentMobileId';

    /**
     * @return string
     */
    public function getApiName(): string;

    /**
     * @param array $params
     * @return self
     */
    public function setBodyParameters(array $params): self;

    /**
     * @return array
     */
    public function getBodyParameters(): array;
}