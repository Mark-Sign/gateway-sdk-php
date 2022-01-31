<?php

namespace AppBundle\GatewaySDKPhp\RequestBuilder\Partials;

use AppBundle\GatewaySDKPhp\RequestBuilder\Traits\TraitBuildParameters;

class Signer
{
    use TraitBuildParameters;
    
    /**
     * Signer's name
     *
     * @var string
     */
    protected $name;

    /**
     * Signer's surname
     *
     * @var string
     */
    protected $surname;

    /**
     * Signer's email
     *
     * @var string
     */
    protected $email;

    /**
     * Document upload success redirection URL
     *
     * @var string
     */
    protected $successUrl;

    /**
     * If TRUE then email with invitation URL will not be sent to signer
     *
     * @var bool
     */
    protected $noEmail;

    /**
     * Get signer's name
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set signer's name
     *
     * @param  string  $name  Signer's name
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get signer's surname
     *
     * @return  string
     */ 
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set signer's surname
     *
     * @param  string  $surname  Signer's surname
     *
     * @return  self
     */ 
    public function setSurname(string $surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get signer's email
     *
     * @return  string
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set signer's email
     *
     * @param  string  $email  Signer's email
     *
     * @return  self
     */ 
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get document upload success redirection URL
     *
     * @return  string
     */ 
    public function getSuccessUrl()
    {
        return $this->successUrl;
    }

    /**
     * Set document upload success redirection URL
     *
     * @param  string  $successUrl  Document upload success redirection URL
     *
     * @return  self
     */ 
    public function setSuccessUrl(string $successUrl)
    {
        $this->successUrl = $successUrl;

        return $this;
    }

    /**
     * Get whether email with invitation URL will not be sent to signer
     *
     * @return  bool
     */ 
    public function getNoEmail()
    {
        return $this->noEmail;
    }

    /**
     * Set whether email with invitation URL will not be sent to signer
     *
     * @param  bool  $noEmail  whether email with invitation URL will not be sent to signer
     *
     * @return  self
     */ 
    public function setNoEmail(bool $noEmail)
    {
        $this->noEmail = $noEmail;

        return $this;
    }
}
