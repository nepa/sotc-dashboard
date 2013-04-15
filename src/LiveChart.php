<?php

require_once('StatisticsChart.php');

/**
 * Class to draw a statistics chart with live data for the
 * current day. This class is a child of the abstract base
 * class StatisticsChart and implements the preparaData()
 * method to get the desired data from the REST client
 * object.
 *
 * \author seidel
 */
class LiveChart extends StatisticsChart
{
  /** First content type for chart */
  private static $firstContentType = 'noiseLevels';

  /** Second content type for chart */
  private static $secondContentType = 'soundSamples';

  /**
   * Parameterless constructor creates a new chart with
   * live data of the current day and sets the chart's
   * title accordingly.
   */
  public function __construct()
  {
    parent::__construct(self::$firstContentType);

    $this->chartTitle = 'Gerade';
  }

  /**
   * Create a data object and use REST client to populate
   * it with information from remote server.
   */
  protected function prepareData($client)
  {
    $data = new pData();

    /**************************************************************
     * Get data for first content type                            *
     **************************************************************/

    // Get today's data from REST client
    $todayData = $client->getData('today');

    // Extract values (e.g. number of reports)
    $values = array();
    for ($i = 0; $i < count($todayData); $i++)
    {
      $values[] = $todayData[$i]['ReportsCounter'];
    }

    // Set values and name of first series (for legend)
    $data->addPoints($values, $this->contentTypeName);
    $data->setSerieOnAxis($this->contentTypeName, 0);

    /**************************************************************
     * Get data for second content type                           *
     **************************************************************/

    // Connect to remote server and fetch new data
    $client = new SummaryClient(self::$secondContentType);
    $client->refreshStatistics();

    // Get today's data from REST client
    $todayData = $client->getData('today');

    // Extract values (e.g. number of reports)
    $values = array();
    for ($i = 0; $i < count($todayData); $i++)
    {
      $values[] = $todayData[$i]['ReportsCounter'];
    }

    // Set values and name of second series (for legend)
    $contentTypeName = $this->mapContentType(self::$secondContentType);
    $data->addPoints($values, $contentTypeName);
    $data->setSerieOnAxis($contentTypeName, 1);

    /**************************************************************
     * Set labels on x and y axis                                 *
     **************************************************************/

    // Set name of Y axis
    $data->setAxisName(0, 'Anzahl Messungen');
    $data->setAxisName(1, 'Anzahl Aufnahmen');

    // Set position of names
    $data->setAxisPosition(0, AXIS_POSITION_LEFT);
    $data->setAxisPosition(1, AXIS_POSITION_RIGHT);

    // Extract labels for X axis
    $labels = array();
    for ($i = 0; $i < count($todayData); $i++)
    {
      // Format in data array is: YYYY-mm-dd, HH:ii:ss
      // We cut it down to: HH
      $labels[] = substr($todayData[$i]['Date'], 12, 2);
    }

    // Assign labels to X axis
    $data->addPoints($labels, 'Labels');
    $data->setSerieDescription('Labels', 'Stunden');
    $data->setAbscissa('Labels');
    $data->setAbscissaName('Stunden');

    return $data;
  }
}

?>
