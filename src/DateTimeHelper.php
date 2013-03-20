<?php

/**
 * This is a helper class to handle issues related
 * to date and time. The class is able to return
 * various UNIX timestamps, especially those of
 * the last twelve months or last 24 hours.
 *
 * \author seidel
 */
class DateTimeHelper
{
  /**
   * Get last twelve months as an associative array,
   * containing month as a two-digit number and year
   * as a four-digit number.
   *
   * Current month is last element of the array.
   */
  public static function getLastTwelveMonths()
  {
    $result = array();

    $currentMonth = date('n');
    $currentYear = date('Y');

    // Iterate last twelve months
    $month = $currentMonth;
    $year = $currentYear;
    for ($i = 1; $i <= 12; $i++)
    {
      // Append new values
      $result[] = array('month' => $month, 'year' => $year);

      $month--;

      // One year passed
      if ($month <= 0)
      {
        $year--;
        $month = 12;
      }
    }

    // Reverse array before returning
    return array_reverse($result);
  }

  /**
   * Get UNIX timestamps for last seven days as an associative
   * array. The array contains a human-readable version of the
   * day's date, as well as UNIX timestamps for each the start
   * and end of the day (i.e. 00:00:00 for the beginning and
   * 23:59:59 for the end).
   *
   * Current day is last element of the array. Array elements
   * have 'date', 'begin' and 'end' as their keys.
   */
  public static function getTimestampsOfCurrentWeek()
  {
    $result = array();

    $currentDay = date('j');
    $currentMonth = date('n');
    $currentYear = date('Y');

    // Timestamp for begin of current day
    $timestamp = mktime(0, 0, 0, $currentMonth, $currentDay, $currentYear);

    // Iterate last 7 days
    for ($i = 0; $i < 7; $i++)
    {
      // Format: YYYY-mm-dd
      $dateString = date('Y', $timestamp) . '-' .
                    date('m', $timestamp) . '-' .
                    date('d', $timestamp);

      // Format: UNIX timestamp
      $beginTimestamp = $timestamp;

      // Format: UNIX timestamp
      $endTimestamp = $beginTimestamp + (24 * 3600) - 1; // Plus one day - 1 second

      $result[] = array('date' => $dateString, 'begin' => $beginTimestamp, 'end' => $endTimestamp);

      $timestamp -= (24 * 3600); // Begin of last day
    }

    // Reverse array before returning
    return array_reverse($result);
  }

  /**
   * Calculate beginning and end of a month as UNIX timestamp.
   * Begin is 00:00:00 of first day, end is 23:59:59 of last
   * day if month is over or current timestamp if month is not
   * yet over.
   *
   * Return value is an associative array with 'begin' and
   * 'end' as keys.
   */
  public static function getTimestampsOfMonth($month, $year)
  {
    $currentMonth = date('n');
    $lastDayOfMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    $beginTimestamp = mktime(0, 0, 0, $month, 1, $year);
    $endTimestamp = mktime(23, 59, 59, $month, $lastDayOfMonth, $year);

    // Current month is not yet over
    if ($month == $currentMonth)
    {
      $endTimestamp = time();
    }

    return array('begin' => $beginTimestamp, 'end' => $endTimestamp);
  }

  /**
   * Calculate UNIX timestamps for all 24 hours of the
   * current day. First timestamp will be 00:00:00 of
   * the day, last timestamp is 23:00:00 accordingly.
   */
  public static function getTimestampsOfToday()
  {
    $result = array();

    $currentDay = date('j');
    $currentMonth = date('n');
    $currentYear = date('Y');

    // Iterate all 24 hours
    for ($i = 0; $i < 24; $i++)
    {
      // Format: YYYY-mm-dd, hh:00:00
      $dateString = $currentYear . '-' . DateTimeHelper::fill($currentMonth) . '-' .
                    DateTimeHelper::fill($currentDay) . ', ' . DateTimeHelper::fill($i) .
                    ':00:00';

      // Format: UNIX timestamp
      $timestamp = mktime($i, 0, 0, $currentMonth, $currentDay, $currentYear);

      $result[] = array('date' => $dateString, 'timestamp' => $timestamp);
    }

    return $result;
  }

  /**
   * Private helper method to add a leading zero to
   * a number, if it is too short (e.g. day or month
   * or hour).
   */
  public static function fill($number)
  {
    return str_pad($number, 2, '0', STR_PAD_LEFT);
  }

  /**
   * Translate number of a day to the corresponding English
   * name of it (e.g. '1' is mapped to 'Monday'). With the
   * optional second parameter set to true, the method will
   * return abbreviated names (e.g. '1' is mapped to 'Mon.').
   *
   * For invalid day numbers, the function will simply
   * return an empty string.
   */
  public static function englishNameOfDay($day, $short = false)
  {
    $result = '';

    if ($day == 1)
    {
      $result = ($short ? 'Mon.' : 'Monday');
    }
    else if ($day == 2)
    {
      $result = ($short ? 'Tue.' : 'Tuesday');
    }
    else if ($day == 3)
    {
      $result = ($short ? 'Wed.' : 'Wednesday');
    }
    else if ($day == 4)
    {
      $result = ($short ? 'Thu.' : 'Thursday');
    }
    else if ($day == 5)
    {
      $result = ($short ? 'Fri.' : 'Friday');
    }
    else if ($day == 6)
    {
      $result = ($short ? 'Sat.' : 'Saturday');
    }
    else if ($day == 7)
    {
      $result = ($short ? 'Sun.' : 'Sunday');
    }

    return $result;
  }

  /**
   * Translate number of a day to the corresponding German
   * name of it (e.g. '1' is mapped to 'Montag'). With the
   * optional second parameter set to true, the method will
   * return abbreviated names (e.g. '1' is mapped to 'Mon.').
   *
   * For invalid day numbers, the function will simply
   * return an empty string.
   */
  public static function germanNameOfDay($day, $short = false)
  {
    $result = '';

    if ($day == 1)
    {
      $result = ($short ? 'Mo.' : 'Montag');
    }
    else if ($day == 2)
    {
      $result = ($short ? 'Di.' : 'Dienstag');
    }
    else if ($day == 3)
    {
      $result = ($short ? 'Mi.' : 'Mittwoch');
    }
    else if ($day == 4)
    {
      $result = ($short ? 'Do.' : 'Donnerstag');
    }
    else if ($day == 5)
    {
      $result = ($short ? 'Fr.' : 'Freitag');
    }
    else if ($day == 6)
    {
      $result = ($short ? 'Sa.' : 'Samstag');
    }
    else if ($day == 7)
    {
      $result = ($short ? 'So.' : 'Sonntag');
    }

    return $result;
  }

  /**
   * Translate number of a month to the corresponding English
   * name of it (e.g. '1' is mapped to 'January'). With the
   * optional second parameter set to true, the method will
   * return abbreviated names (e.g. '1' is mapped to 'Jan.').
   *
   * For invalid month numbers, the function will simply
   * return an empty string.
   */
  public static function englishNameOfMonth($month, $short = false)
  {
    $result = '';

    if ($month == 1)
    {
      $result = ($short ? 'Jan.' : 'January');
    }
    else if ($month == 2)
    {
      $result = ($short ? 'Feb.' : 'February');
    }
    else if ($month == 3)
    {
      $result = ($short ? 'Mar.' : 'March');
    }
    else if ($month == 4)
    {
      $result = ($short ? 'Apr.' : 'April');
    }
    else if ($month == 5)
    {
      $result = 'May';
    }
    else if ($month == 6)
    {
      $result = ($short ? 'Jun.' : 'June');
    }
    else if ($month == 7)
    {
      $result = ($short ? 'Jul.' : 'July');
    }
    else if ($month == 8)
    {
      $result = ($short ? 'Aug.' : 'August');
    }
    else if ($month == 9)
    {
      $result = ($short ? 'Sep.' : 'September');
    }
    else if ($month == 10)
    {
      $result = ($short ? 'Oct.' : 'October');
    }
    else if ($month == 11)
    {
      $result = ($short ? 'Nov.' : 'November');
    }
    else if ($month == 12)
    {
      $result = ($short ? 'Dec.' : 'December');
    }

    return $result;
  }

  /**
   * Translate number of a month to the corresponding German
   * name of it (e.g. '1' is mapped to 'Januar'). With the
   * optional second parameter set to true, the method will
   * return abbreviated names (e.g. '1' is mapped to 'Jan.').
   *
   * For invalid month numbers, the function will simply
   * return an empty string.
   */
  public static function germanNameOfMonth($month, $short = false)
  {
    $result = '';

    if ($month == 1)
    {
      $result = ($short ? 'Jan.' : 'Januar');
    }
    else if ($month == 2)
    {
      $result = ($short ? 'Feb.' : 'Februar');
    }
    else if ($month == 3)
    {
      $result = ($short ? 'Mär.' : 'März');
    }
    else if ($month == 4)
    {
      $result = ($short ? 'Apr.' : 'April');
    }
    else if ($month == 5)
    {
      $result = 'Mai';
    }
    else if ($month == 6)
    {
      $result = ($short ? 'Jun.' : 'Juni');
    }
    else if ($month == 7)
    {
      $result = ($short ? 'Jul.' : 'Juli');
    }
    else if ($month == 8)
    {
      $result = ($short ? 'Aug.' : 'August');
    }
    else if ($month == 9)
    {
      $result = ($short ? 'Sep.' : 'September');
    }
    else if ($month == 10)
    {
      $result = ($short ? 'Okt.' : 'Oktober');
    }
    else if ($month == 11)
    {
      $result = ($short ? 'Nov.' : 'November');
    }
    else if ($month == 12)
    {
      $result = ($short ? 'Dez.' : 'Dezember');
    }

    return $result;
  }

  /**
   * This method is used to test the getLastTwelveMonths()
   * and the getTimestampsOfMonth() function.
   */
  public static function __testMonthTimestamps()
  {
    $lastMonths = DateTimeHelper::getLastTwelveMonths();

    for ($i = 0; $i < count($lastMonths); $i++)
    {
      $month = $lastMonths[$i]['month'];
      $year = $lastMonths[$i]['year'];
      $timestamps = DateTimeHelper::getTimestampsOfMonth($month, $year);

      echo '<br /><br />Begin of ' . $year . '-' . DateTimeHelper::fill($month) . ': ' . $timestamps['begin'];
      echo '<br />End of ' . $year . '-' . DateTimeHelper::fill($month) . ': ' . $timestamps['end'];
    }
  }

  /**
   * This method is used to test the getTimestampsOfCurrentWeek()
   * function.
   */
  public static function __testCurrentWeekTimestamps()
  {
    $lastDays = DateTimeHelper::getTimestampsOfCurrentWeek();

    // Print date, timestamp and human-readable version of timestamp
    for ($i = 0; $i < count($lastDays); $i++)
    {
      echo '<br /><br />Begin of ' . $lastDays[$i]['date'] . ': ' . $lastDays[$i]['begin'] .
        ' (= ' . date('Y-m-d, H:i:s', $lastDays[$i]['begin']) . ')';

      echo '<br />End of ' . $lastDays[$i]['date'] . ': ' . $lastDays[$i]['end'] .
        ' (= ' . date('Y-m-d, H:i:s', $lastDays[$i]['end']) . ')';
    }
  }

  /**
   * This method is used to test the getTimestampsOfToday()
   * function.
   */
  public static function __testDayTimestamps()
  {
    $lastHours = DateTimeHelper::getTimestampsOfToday();

    for ($i = 0; $i < count($lastHours); $i++)
    {
      echo '<br /><br />Timestamp of ' . $lastHours[$i]['date'] . ': ' . $lastHours[$i]['timestamp'];
    }
  }
}

?>
