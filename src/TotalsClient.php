<?php

require_once('RESTClient.php');

/**
 * This class contains a REST client to query the use statistics
 * resource of the SotC REST API. More specific, this class can
 * print a JSON document that contains information about the
 * overall usage of the service (e.g. total number of reports
 * for every content type).
 *
 * \author seidel
 */
class TotalsClient extends RESTClient
{
  /**
   * Send JSON code with data about overall usage of
   * service to the user's webbrowser. The returned
   * document will contain information about all
   * content types for the time period 'ever'.
   */
  public function printTotals()
  {
    // Create result array
    $result = array();
    $result['NoiseLevelsCounter'] = self::countReports('noiseLevels');
    $result['SoundSamplesCounter'] = self::countReports('soundSamples');
    $result['DeviceInfosCounter'] = self::countReports('deviceInfos');
    $result['UniqueUsersCounter'] = self::countReports('uniqueUsers');

    // Echo result array as JSON code
    echo json_encode($result);
  }
}

// Send JSON code to browser
$client = new TotalsClient();
$client->printTotals();

?>
