<?php
/**
 * Created by PhpStorm.
 * User: gordon
 * Date: 7/5/2561
 * Time: 11:34 น.
 */
namespace Suilven\TimeZones;

use Carbon\Carbon;
use SilverStripe\ORM\FieldType\DBDatetime;

class TimeZoneHelper
{
    /**
     * @param DBDatetime $dateTime the SilverStripe date time object
     * @param null|string $timezone Optional timezone, otherwise will default to PHP setting
     */
    public function convertToUTC(DBDatetime $dateTime, $timezone = null)
    {
        // use the provided timezone, or if not provided the value in ini_get
        $timezone = !empty($timezone) ? $timezone : ini_get('date.timezone');
        error_log('TIMEZONE: ' . $timezone);
        $timestamp = $dateTime->getTimestamp();
        error_log('TIMESTAMP: ' . $timestamp);
        $carbon = Carbon::createFromTimestamp($timestamp);
        error_log(print_r($carbon, 1));
        return $carbon->setTimezone('UTC');
    }
}
