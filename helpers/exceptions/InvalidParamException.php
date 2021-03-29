<?php

    namespace nyx\base\helpers\exceptions;

    /**
     * Class InvalidParamException
     *
     * @package nyx\base\helpers\exceptions
     */
    class InvalidParamException extends \Exception
    {
        /**
         * @return string the user-friendly name of this exception
         */
        public function getName()
        {
            return 'Invalid Parameter';
        }
    }
