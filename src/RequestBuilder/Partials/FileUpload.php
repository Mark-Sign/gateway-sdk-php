<?php

namespace AppBundle\GatewaySDKPhp\RequestBuilder\Partials;

use AppBundle\GatewaySDKPhp\RequestBuilder\Traits\TraitBuildParameters;
use AppBundle\GatewaySDKPhp\RequestBuilder\Annotations\RequestParameter;

class FileUpload
{
    use TraitBuildParameters;
    
    /**
     * Name of the file
     *
     * @var string
     * @RequestParameter(name = "filename")
     */
    protected $filename;

    /**
     * Name of the file
     *
     * @var string
     * @RequestParameter(name = "name")
     */
    protected $name;

    /**
     * Base64 encoded content of the file
     *
     * @var string
     * @RequestParameter(name = "content")
     */
    protected $content;

    /**
     * SHA256 checksum of file content
     *
     * @var string
     * @RequestParameter(name = "digest")
     */
    protected $digest;

    /**
     * Callback URL to send uuid after signing
     *
     * @var string
     * @RequestParameter(name = "callbackUrl")
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
     * Get name of the file
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name of the file
     *
     * @param  string  $name  Name of the file
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

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

    /**
     * Get sHA256 checksum of file content
     *
     * @return  string
     */ 
    public function getDigest()
    {
        return $this->digest;
    }

    /**
     * Set sHA256 checksum of file content
     *
     * @param  string  $digest  SHA256 checksum of file content
     *
     * @return  self
     */ 
    public function setDigest(string $digest)
    {
        $this->digest = $digest;

        return $this;
    }
}
