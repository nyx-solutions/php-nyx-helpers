<?php

    namespace nyx\base\helpers\exceptions;

    use Exception;

    /**
     * Invalid Variable Type Exception
     */
    class InvalidVariableTypeException extends Exception
    {
        /**
         * @param string $type
         */
        public function __construct(string $type)
        {
            $this->message = "The variable must be of the type \"{$type}\".";
            $this->code    = 0;

            parent::__construct();
        }
    }
