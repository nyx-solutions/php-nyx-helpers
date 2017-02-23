<?php

    namespace nox\base\helpers;

    /**
     * Class SlugHelper
     *
     * @package nox\base\helpers
     */
    class SlugHelper extends StringHelper
    {
        /**
         * @param string  $value
         * @param string  $spaces
         * @param integer $case
         *
         * @return string
         */
        public static function convert($value = '', $spaces = '-', $case = MB_CASE_LOWER)
        {
            return static::asSlug($value, $spaces, $case);
        }
    }
