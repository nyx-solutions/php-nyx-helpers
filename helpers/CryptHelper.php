<?php

    namespace nox\base\helpers;

    /**
     * Class CryptHelper
     *
     * @package nox\base\helpers
     */
    class CryptHelper extends StringHelper
    {
        const SECRET = '348090af7ef0621b1fc980719b890596ed6a22be6ee5137de4ded23b8867a598f9d7e7d5fec22b9f3647ff42b148b9ee98003aab116206816ec9827b9915b56c';

        /**
         * @param $string
         *
         * @return string
         */
        public static function encrypt($string)
        {
            $key = pack('H*', self::SECRET);

            $encryption_key = base64_decode($key);

            $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));

            $encrypted = openssl_encrypt($string, 'aes-256-cbc', $encryption_key, 0, $iv);

            return base64_encode($encrypted . '::' . $iv);
        }

        /**
         * @param $string
         *
         * @return string
         */
        public static function decrypt($string)
        {
            $key = pack('H*', self::SECRET);

            $encryption_key = base64_decode($key);

            list($encrypted_data, $iv) = explode('::', base64_decode($string), 2);

            return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
        }
    }
