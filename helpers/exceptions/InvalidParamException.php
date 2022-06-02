<?php

    namespace nyx\base\helpers\exceptions;

    use Exception;

    /**
     * Invalid Param Exception
     */
    class InvalidParamException extends Exception
    {
        /**
         * @return string the user-friendly name of this exception
         */
        public function getName(): string
        {
            return 'Invalid Parameter';
        }
    }
