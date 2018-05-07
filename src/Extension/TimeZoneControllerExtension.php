<?php
/**
 * Created by PhpStorm.
 * User: gordon
 * Date: 7/5/2561
 * Time: 11:34 น.
 */
namespace Suilven\TimeZones\Extension;

use Carbon\Carbon;
use SilverStripe\Core\Extension;
use SilverStripe\ORM\FieldType\DBDatetime;
use Suilven\TimeZones\TemplateModel\FormattableCarbon;

class TimeZoneControllerExtension extends Extension
{
    /**
     * @param string $dateTime string of time passed in from the template
     * @param null|string $timezone Optional timezone, otherwise will default to configured client timezone, then php.ini
     */
    public function TimeInClientTimeZone( $dateTimeString, $providedTimeZone = null)
    {
        if (empty($dateTimeString)) {
            return '';
        } else {
            $carbon = Carbon::createFromTimeString($dateTimeString);
            return new FormattableCarbon($carbon, $providedTimeZone);
        }
/*
        error_log('TIMEZONE: ' . $timezone);
        $timestamp = $dateTime->getTimestamp();
        error_log('TIMESTAMP: ' . $timestamp);
        $carbon = Carbon::createFromTimestamp($timestamp);
        error_log(print_r($carbon, 1));
        return $carbon->setTimezone('UTC');
*/
    }

    /**
     * @param null $providedTimeZone
     * @return string
     */
    public function NowInClientTimeZone($providedTimeZone = null)
    {
        $forTemplate = new FormattableCarbon(Carbon::now(), $providedTimeZone);
        return $forTemplate;
    }

}
