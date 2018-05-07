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
     * @param null|string $timezone Optional timezone, otherwise will default to PHP setting
     */
    public function convertToUTC(DBDatetime $dateTime, $timezone = null)
    {
        // use the provided timezone, or if not provided the value in ini_get
        $timezone = !empty($timezone) ? $timezone : ini_get('date.timezone');
        $timestamp = $dateTime->getTimestamp();
        echo $timestamp;
        $carbon = Carbon::createFromTimestamp($timestamp);
        echo $carbon;
        return $carbon->setTimezone('UTC');
    }
}
