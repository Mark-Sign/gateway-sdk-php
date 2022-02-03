<?php

namespace AppBundle\GatewaySDKPhp\RequestBuilder\Partials;

use AppBundle\GatewaySDKPhp\RequestBuilder\Traits\TraitBuildParameters;
use AppBundle\GatewaySDKPhp\RequestBuilder\Annotations\RequestParameter;
use InvalidArgumentException;

class Files
{
    use TraitBuildParameters;
    
    /**
     * Array of FileUpload
     *
     * @var FileUpload[]
     * @RequestParameter(name = "files")
     */
    protected $files;

    /**
     * Get Array of FileUpload
     *
     * @return FileUpload[]
     */ 
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * Set Array of FileUpload
     *
     * @param FileUpload[]  $files  Array of FileUpload
     *
     * @return  self
     */ 
    public function setFiles(array $files)
    {
        foreach ($files AS $file) {
            if (!$file instanceof FileUpload) {
                throw new InvalidArgumentException("All values must be type of " . FileUpload::class);
            }
        }
        
        $this->files = $files;

        return $this;
    }
}
