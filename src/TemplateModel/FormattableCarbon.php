<?php
/**
 * Created by PhpStorm.
 * User: gordon
 * Date: 7/5/2561
 * Time: 11:34 น.
 */
namespace Suilven\TimeZones\TemplateModel;

use Carbon\Carbon;
use SilverStripe\ORM\FieldType\DBDatetime;
use SilverStripe\View\ViewableData;
use Suilven\TimeZones\Helper\TimeZoneHelper;

class FormattableCarbon extends ViewableData
{
    protected $carbon;

   public function __construct($newCarbon, $timezone)
   {
       $this->carbon = $newCarbon;
   }

    /**
     * In capitals for template usage
     */
   public function Format($formatName, $providedTimeZone = null)
   {
       // get the timezone
       $helper = new TimeZoneHelper();
       $timezone = $helper->getTimeZone($providedTimeZone);

       // get a named format
       $namedFormats = $this->config()->get('date_formats');
       $format = isset($namedFormats[$formatName]) ? $namedFormats[$formatName] : null;
       return !empty($format)
           ? $this->carbon->timezone($timezone)->format($format)
           : user_error('Format of name "' . $formatName . '" could not be found');
   }

   public function getCarbon()
   {
       return $this->carbon;
   }

}
