<?php

namespace AppBundle\GatewaySDKPhp\RequestBuilder\Partials;

use AppBundle\GatewaySDKPhp\RequestBuilder\Traits\TraitBuildParameters;

class FileUpload
{
    use TraitBuildParameters;
    
    /**
     * Name of the file
     *
     * @var string
     */
    protected $filename;

    /**
     * Base64 encoded content of the file
     *
     * @var string
     */
    protected $content;

    /**
     * Callback URL to send uuid after signing
     *
     * @var string
     */
    protected $callbackUrl;

    /**
     * Get name of the file
     *
     * @return  string
     */ 
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set name of the file
     *
     * @param  string  $filename  Name of the file
     *
     * @return  self
     */ 
    public function setFilename(string $filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get base64 encoded content of the file
     *
     * @return  string
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set base64 encoded content of the file
     *
     * @param  string  $content  Base64 encoded content of the file
     *
     * @return  self
     */ 
    public function setContent(string $content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get callback URL to send uuid after signing
     *
     * @return  string
     */ 
    public function getCallbackUrl()
    {
        return $this->callbackUrl;
    }

    /**
     * Set callback URL to send uuid after signing
     *
     * @param  string  $callbackUrl  Callback URL to send uuid after signing
     *
     * @return  self
     */ 
    public function setCallbackUrl(string $callbackUrl)
    {
        $this->callbackUrl = $callbackUrl;

        return $this;
    }
}
