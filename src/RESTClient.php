<?php

/**
 * Abstract base class for all REST clients that query the use
 * statistics resource of the SotC REST API. This class contains
 * general methods that are being utilized in all special-purpose
 * REST clients of the SotC dashboard.
 *
 * \author seidel
 */
abstract class RESTClient
{
  /** Base URL for service endpoint */
  private static $service_url = 'https://citysound.itm.uni-luebeck.de/rest/v1.3/';

  /**
   * Static helper method to do GET requests and generally fetch
   * information from a remote server. This function will simply
   * issue HTTP requests to the desired resource and return the
   * result as an associative array.
   */
  protected static function doGETRequest($resource)
  {
    $options = array(
      'http' => array(
        'method' => 'GET',
        'header' => 'Content-Type: application/json' . "\r\n"
      )
    );
    $context = stream_context_create($options);

    $result = @file_get_contents(self::$service_url . $resource, false, $context);
    if ($result === false)
    {
      die('<p><b>Error:</b> Cannot connect to remote server. REST resource unavailable.</p>');
    }
    else
    {
      // Decode server response
      $result = json_decode($result, true);
    }

    return $result;
  }

  /**
   * Static helper method to count the number of reports for
   * a specific content type and time period in the service's
   * use statistics. The method will add thousands separators
   * to large numbers and returns the overall result as an
   * associative array.
   */
  protected static function countReports($contentType = 'noiseLevels', $timePeriod = 'ever')
  {
    $what = $contentType;
    $when = $timePeriod;
    $query = 'useStats/count/?what=' . $what . '&when=' . $when;

    $response = self::doGETRequest($query);

    return number_format($response['UseStatistics']['ReportsCounter'], 0, ',', '.');
  }
}

?>
