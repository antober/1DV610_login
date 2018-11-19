<?php

class Timestamp {
    private static $YEAR_TOTAL_SEC = 31536000;
    private static $MONTH_TOTAL_SEC = 2592000;
    private static $WEEK_TOTAL_SEC = 604800;
    private static $DAY_TOTAL_SEC = 86400;
    private static $HOUR_TOTAL_SEC = 3600;
    private static $MINUTE_TOTAL_SEC = 60;
    private static $SECOND_TOTAL = 1;
    private static $year = 'year';
    private static $month = 'month';
    private static $week = 'week';
    private static $day = 'day';
    private static $hour = 'hour';
    private static $minute = 'minute';
    private static $second = 'second';

    public function calcTimeElapsed($timestamp) {
        $time = strtotime($timestamp);
        $time = time() - $time;
        $time = ($time<1)? 1 : $time;
        $tokens = array (
           self::$YEAR_TOTAL_SEC => self::$year,
           self::$MONTH_TOTAL_SEC => self::$month,
           self::$WEEK_TOTAL_SEC => self::$week,
           self::$DAY_TOTAL_SEC => self::$day,
           self::$HOUR_TOTAL_SEC => self::$hour,
           self::$MINUTE_TOTAL_SEC => self::$minute,
           self::$SECOND_TOTAL => self::$second
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
        }
    }
}