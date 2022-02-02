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

    public const API_NAME_MOBILE_ID_INIT_AUTH = 'apiMobileidInitAuth';
    public const API_NAME_MOBILE_ID_IDENT8N_SESSION_STATUS = 'apiMobileidCheckIdentificationSessionStatus';
    public const API_NAME_MOBILE_ID_INIT_SIGNING = 'apiMobileidInitSigning';
    public const API_NAME_MOBILE_ID_SIGNING_STATUS = 'apiMobileidSigningStatus';
    public const API_NAME_MOBILE_ID_INIT_HASH_SIGNING = 'apiMobileidInitHashSigning';
    public const API_NAME_MOBILE_ID_HASH_SIGNING_STATUS = 'apiMobileidHashSigningStatus';
    public const API_NAME_MOBILE_ID_IDENT8N_REMOVE = 'apiMobileidIdentificationRemove';

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