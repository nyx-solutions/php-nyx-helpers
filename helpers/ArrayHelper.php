<?php

    namespace nyx\base\helpers;

    /**
     * Array Helper
     */
    class ArrayHelper extends BaseArrayHelper
    {
        protected const SLUG_METHOD_SINGLE = 1;
        protected const SLUG_METHOD_AS_KEY = 2;

        /**
         * @param array $items
         * @param int   $method
         *
         * @return array
         */
        public static function asSlugs(array $items, int $method = self::SLUG_METHOD_SINGLE): array
        {
            if (!empty($items)) {
                $slugs = [];

                foreach ($items as $item) {
                    $slug = StringHelper::asSlug((string)$item);

                    if ($method === self::SLUG_METHOD_SINGLE) {
                        $slugs[] = $slug;
                    } else {
                        $slugs[$slug] = (string)$item;
                    }
                }

                return $slugs;
            }

            return [];
        }

        /**
         * @param array $items
         *
         * @return array
         */
        public static function asAssociative(array $items): array
        {
            if (!empty($items)) {
                $newItems = [];

                foreach ($items as $item) {
                    $newItems[(string)$item] = (string)$item;
                }

                return $newItems;
            }

            return [];
        }

        /**
         * @param array $items
         *
         * @return array
         *
         * @see static::asAssociative()
         *
         * @deprecated
         */
        public static function asAssociate(array $items): array
        {
            return static::asAssociative($items);
        }
    }
