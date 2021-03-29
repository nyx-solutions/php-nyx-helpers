<?php

    namespace nyx\base\helpers\exceptions;

    /**
     * Class InvalidVariableTypeException
     *
     * @package nyx\base\helpers\exceptions
     */
    class InvalidVariableTypeException extends \Exception
    {
        /**
         * @param string $type
         */
        public function __construct($type)
        {
            $this->message = "The variable must be of the type \"{$type}\".";
            $this->code    = 0;
        }
    }
