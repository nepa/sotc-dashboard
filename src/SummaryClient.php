<?php

require_once('RESTClient.php');

/**
 * This class contains a REST client to query the use statistics
 * resource of the SotC REST API. More specific, this class uses
 * the summary method to get an overview of reports today, in the
 * current week and within the last twelve months.
 *
 * On default, the data is only fetched once from the remote site,
 * and can then be read locally multiple times (mostly for reasons
 * of performance). However, you can update the cached information
 * at any time by calling refreshStatistics().
 *
 * \author seidel
 */
class SummaryClient extends RESTClient
{
  /** Content type for statistics summary */
  private $contentType = -1;

  /** Timestamp of data that is currently cached */
  private $lastUpdate;

  /** Cached use statistics data */
  private $cachedData;

  /**
   * Constructor creates a new REST client and tries to fetch
   * initial statistics summary for the desired content type.
   */
  public function __construct($contentType)
  {
    $this->contentType = $contentType;
    $this->lastUpdate = 0;
    $this->cachedData = array();

    // Fetch remote data
    $this->refreshStatistics();
  }

  /**
   * Fetch use statistics from remote server and save them
   * in a local member variable of the REST client. To
   * access cached information, use the getData() method.
   */
  public function refreshStatistics()
  {
    $query = 'useStats/summary/?what=' . $this->contentType;

    $response = self::doGETRequest($query);

    // Check status code of response
    if (isset($response['Statuscode']) && $response['Statuscode'] == 'OK')
    {
      if (isset($response['StatisticsSummary']) && isset($response['StatisticsSummary']['NowTimestamp']))
      {
        $this->lastUpdate = $response['StatisticsSummary']['NowTimestamp'];
      }

      $this->cachedData = $response;
    }
    else
    {
      $errorMessage = (isset($response['Message']) ? $response['Message'] : 'Could not fetch remote data.');

      die('<p><b>Error:</b> ' . $errorMessage . '</p>');
    }
  }

  /**
   * Get UNIX timestamp that was set, when the cached
   * use statistics was refreshed last time.
   */
  public function getLastRefreshTimestamp()
  {
    return $this->lastUpdate;
  }

  /**
   * Access selected segments of the cached use statistics.
   * Currently, the data is divided into three sections, namely
   * 'today' for accumulated information about the current day,
   * 'week' for data of the current week and 'last-months' for
   * a statistics summary of the last twelve months.
   */
  public function getData($segment = 'today')
  {
    $result = array();

    // Select segment with data for today
    if ($segment == 'today' &&
        isset($this->cachedData['StatisticsSummary']) &&
        isset($this->cachedData['StatisticsSummary']['SummaryData']) &&
        isset($this->cachedData['StatisticsSummary']['SummaryData']['Today']))
    {
      $result = $this->cachedData['StatisticsSummary']['SummaryData']['Today'];
    }
    // Select segment with data for current week
    else if ($segment == 'week' &&
             isset($this->cachedData['StatisticsSummary']) &&
             isset($this->cachedData['StatisticsSummary']['SummaryData']) &&
             isset($this->cachedData['StatisticsSummary']['SummaryData']['CurrentWeek']))
    {
      $result = $this->cachedData['StatisticsSummary']['SummaryData']['CurrentWeek'];
    }
    // Select segment with data about last 12 months
    else if ($segment == 'last-months' &&
             isset($this->cachedData['StatisticsSummary']) &&
             isset($this->cachedData['StatisticsSummary']['SummaryData']) &&
             isset($this->cachedData['StatisticsSummary']['SummaryData']['LastMonths']))
    {
      $result = $this->cachedData['StatisticsSummary']['SummaryData']['LastMonths'];
    }
    else
    {
      die('<p><b>Error:</b> Invalid segment of use statistics requested.</p>');
    }

    return $result;
  }
}

?>
