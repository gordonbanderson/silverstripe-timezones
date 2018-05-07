<?php
/**
 * Created by PhpStorm.
 * User: gordon
 * Date: 7/5/2561
 * Time: 11:34 น.
 */
namespace Suilven\TimeZones\Helper;

use Carbon\Carbon;
use SilverStripe\Core\Config\Config;
use SilverStripe\ORM\FieldType\DBDatetime;
use Suilven\TimeZones\TemplateModel\FormattableCarbon;

class TimeZoneHelper
{
    /**
     * @param DBDatetime $dateTime the SilverStripe date time object
     * @param null|string $timezone Optional timezone, otherwise will default to PHP setting
     */
    public function convertToUTC(DBDatetime $dateTime, $providedTimezone = null)
    {
        // use the provided timezone, or if not provided the value in ini_get
        $timezone = $this->getTimeZone($providedTimezone);
        $timestamp = $dateTime->getTimestamp();
        $carbon = Carbon::createFromTimestamp($timestamp);
        return $carbon->setTimezone('UTC');
    }

    /**
     * @param $timezone
     * @return string
     */
    public function getTimeZone($timezone)
    {
        // use the provided timezone, or if not provided the value in ini_get
        $timezone = !empty($timezone) ? $timezone : Config::inst()->get(FormattableCarbon::class, 'timezone');
        if (empty($timezone)) {
            $timezone = ini_get('date.timezone');
        }

        return $timezone;
    }
}
