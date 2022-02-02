<?php


namespace AppBundle\GatewaySDKPhp\Model;


interface RequestInterface
{
    public const API_NAME_SIGN_DOCUMENT_SMART_ID = 'apiSignDocumentSmartId';
    public const API_NAME_SIGN_DOCUMENT_MOBILE_ID = 'apiSignDocumentMobileId';
    public const API_NAME_DOCUMENT_UPLOAD = 'apiDocumentUpload';
    public const API_NAME_DOCUMENT_VALIDATION = 'apiDocumentValidation';
    public const API_NAME_DOCUMENT_FILE_VALIDATION = 'apiDocumentFileValidation';
    public const API_NAME_DOCUMENT_SIGNER_INVITE = 'apiDocumentSignerInvite';
    public const API_NAME_DOCUMENT_STATUS_CHECK = 'apiDocumentStatusCheck';
    public const API_NAME_DOCUMENT_DOWNLOAD = 'apiDocumentDownload';
    public const API_NAME_DOCUMENT_REMOVE = 'apiDocumentRemove';

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