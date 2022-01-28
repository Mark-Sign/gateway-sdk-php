<?php

namespace AppBundle\GatewaySDKPhp\RequestBuilder\Traits;

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
    public function buildParameters()
    {
        $vars = get_class_vars(get_class($this));
        $return = [];
        foreach ($vars as $var => $value) {

            if (!isset($this->$var)) continue;

            if ($this->usesBuildParametersTrait($this->$var)) {
                // If current attribute value is object, and uses this trait, then call that object's trait method
                // Please note that, the object might be traversable, in which case, it might have to be traversed to find if they are using the trait or not
                // Will be implemented later, if necessary

                $return[$var] = $this->$var->buildParameters();
            } else if (is_array($this->$var)) {
                // If it's an array, check for its elements if they are using this trait, if yes, then call that object's trait method

                $array = [];
                foreach ($this->$var as $key => $value) {
                    if ($this->usesBuildParametersTrait($value)) {
                        $array[$key] = $value->buildParameters();
                    } else {
                        $array[$key] = $value;
                    }
                }
                $return[$var] = $array;
            } else {

                $return[$var] = $this->$var;
            }
        }
        return $return;
    }

    public function usesBuildParametersTrait($var)
    {
        return is_object($var) && count($classUses = class_uses($var)) > 0 && in_array(__TRAIT__, $classUses);
    }
}
