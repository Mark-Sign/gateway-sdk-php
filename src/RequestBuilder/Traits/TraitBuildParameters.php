<?php

namespace AppBundle\GatewaySDKPhp\RequestBuilder\Traits;

use AppBundle\GatewaySDKPhp\RequestBuilder\Annotations\RequestParameter;
use ReflectionClass;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

/**
 * Trait for building parameters
 */
trait TraitBuildParameters
{
    /**
     * Builds parameters from class attributes
     *
     * @return array
     */
    public function buildParameters(): array
    {
        AnnotationRegistry::registerLoader('class_exists');
        
        $reflectionClass = new ReflectionClass(get_class($this));
        $properties = $reflectionClass->getProperties();
        $reader = new AnnotationReader();

        $return = [];
        foreach ($properties as $property) {

            $propertyName = $property->getName();

            $requestParameter = $reader->getPropertyAnnotation(
                $property,
                RequestParameter::class
            );

            if (!isset($this->$propertyName) || is_null($requestParameter)) continue;

            $parameterName = $requestParameter->name;

            if ($this->usesBuildParametersTrait($this->$propertyName)) {
                // If current attribute value is object, and uses this trait, then call that object's trait method
                // Please note that, the object might be traversable, in which case, it might have to be traversed to find if they are using the trait or not
                // Will be implemented later, if necessary

                $return[$parameterName] = $this->$propertyName->buildParameters();

            } else if (is_array($this->$propertyName)) {
                // If it's an array, check for its elements if they are using this trait, if yes, then call that object's trait method

                $array = [];
                foreach ($this->$propertyName as $key => $value) {
                    if ($this->usesBuildParametersTrait($value)) {
                        $array[$key] = $value->buildParameters();
                    } else {
                        $array[$key] = $value;
                    }
                }
                $return[$parameterName] = $array;
            } else {

                $return[$parameterName] = $this->$propertyName;
            }
        }
        return $return;
    }

    public function usesBuildParametersTrait($var)
    {
        return is_object($var) && count($classUses = class_uses($var)) > 0 && in_array(__TRAIT__, $classUses);
    }
}
