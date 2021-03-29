<?php

    namespace nyx\base\helpers;

    use Carbon\Carbon;
    use DateInterval;
    use DateTime;
    use DateTimeZone;
    use Exception;

    /**
     * Class DateTimeHelper
     *
     * @package nyx\base\helpers
     */
    class DateTimeHelper extends Carbon
    {
        const TYPE_DATE            = 'date';
        const TYPE_TIME            = 'time';
        const TYPE_DATE_TIME       = 'datetime';
        const TYPE_OTHER           = 'other';

        const BASE_DATE_FORMAT     = 'Y-m-d';
        const BASE_DATETIME_FORMAT = 'Y-m-d H:i:s';
        const BASE_TIME_FORMAT     = 'H:i:s';

        /**
         * @var string
         */
        public static string $currentTimeZone = 'America/Sao_Paulo';

        /**
         * @inheritdoc
         */
        public function __construct($time = 'now', DateTimeZone $timezone = null)
        {
            if (is_null($timezone)) {
                $timezone = new DateTimeZone(static::$currentTimeZone);
            }

            parent::__construct($time, $timezone);
        }

        /**
         * @param string $date
         * @param string $sourceFormat
         * @param string $targetFormat
         * @param string $type
         *
         * @return string
         */
        public static function convert($date, $sourceFormat = 'd/m/Y', $targetFormat = 'Y-m-d', $type = 'date')
        {
            $date = (string)$date;

            if (!in_array($type, [self::TYPE_DATE, self::TYPE_TIME, self::TYPE_DATE_TIME, self::TYPE_OTHER])) {
                return '';
            }

            if (empty($date)) {
                return '';
            }

            if ($type === self::TYPE_DATE_TIME) {
                $fmt = (is_null($sourceFormat) || empty($sourceFormat)) ? self::BASE_DATETIME_FORMAT : $sourceFormat;
            } elseif ($type === self::TYPE_TIME) {
                $fmt = (is_null($sourceFormat) || empty($sourceFormat)) ? self::BASE_TIME_FORMAT : $sourceFormat;
            } elseif ($type === self::TYPE_DATE) {
                $fmt = (is_null($sourceFormat) || empty($sourceFormat)) ? self::BASE_DATE_FORMAT : $sourceFormat;
            } else {
                if (is_null($sourceFormat) || empty($sourceFormat)) {
                    return '';
                } else {
                    $fmt = $sourceFormat;
                }
            }

            $sourceFormat = $fmt;

            unset($fmt);

            $date = static::createFromFormat($sourceFormat, $date);

            if ($date instanceof DateTime) {
                $date = $date->format($targetFormat);
            } else {
                $date = '';
            }

            return $date;
        }

        /**
         * @param string $date
         * @param string $sourceFormat
         * @param string $type
         *
         * @return static
         *
         * @throws Exception
         */
        public static function asDate($date, $sourceFormat = 'd/m/Y', $type = 'date')
        {
            $date = (string)$date;

            if (!in_array($type, [self::TYPE_DATE, self::TYPE_TIME, self::TYPE_DATE_TIME, self::TYPE_OTHER])) {
                return new static('now', new DateTimeZone(static::$currentTimeZone));
            }

            if (empty($date)) {
                return new static('now', new DateTimeZone(static::$currentTimeZone));
            }

            if ($type === self::TYPE_DATE_TIME) {
                $fmt = (is_null($sourceFormat) || empty($sourceFormat)) ? self::BASE_DATETIME_FORMAT : $sourceFormat;
            } elseif ($type === self::TYPE_TIME) {
                $fmt = (is_null($sourceFormat) || empty($sourceFormat)) ? self::BASE_TIME_FORMAT : $sourceFormat;
            } elseif ($type === self::TYPE_DATE) {
                $fmt = (is_null($sourceFormat) || empty($sourceFormat)) ? self::BASE_DATE_FORMAT : $sourceFormat;
            } else {
                if (is_null($sourceFormat) || empty($sourceFormat)) {
                    $fmt = 'd/m/Y';
                } else {
                    $fmt = $sourceFormat;
                }
            }

            $sourceFormat = $fmt;

            unset($fmt);

            $date = static::createFromFormat($sourceFormat, $date, new DateTimeZone(static::$currentTimeZone));

            if (!$date instanceof DateTime) {
                $date = new static('now', new DateTimeZone(static::$currentTimeZone));
            }

            return $date;
        }

        /**
         * @param string $date
         * @param string $format
         * @param string $returnFormat
         *
         * @return bool|string
         */
        public static function isValid($date, $format = 'Y-m-d', $returnFormat = 'Y-m-d')
        {
            $date = (string)$date;

            if (!empty($date) && !is_null($date)) {
                if (preg_match('/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/', $date)) {
                    $date = static::createFromFormat('d/m/Y', $date, new DateTimeZone(static::$currentTimeZone));

                    if ($date instanceof DateTime) {
                        return $date->format($returnFormat);
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        /**
         * @param string $birthdate
         * @param string $format
         *
         * @return integer
         *
         * @throws Exception
         */
        public static function getAge($birthdate, $format = 'Y-m-d')
        {
            if (!empty((string)$birthdate)) {
                $date     = static::createFromFormat($format, $birthdate, new DateTimeZone(static::$currentTimeZone));

                $now      = new static('now', new DateTimeZone(static::$currentTimeZone));

                if ($now instanceof DateTime) {
                    $interval = $now->diff($date);

                    if ($interval instanceof DateInterval) {
                        return $interval->y;
                    }
                }
            }

            return 0;
        }
    }
