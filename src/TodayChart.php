<?php

require_once('StatisticsChart.php');

/**
 * Class to draw a statistics chart with today's data.
 * This class is a child of the abstract base class
 * StatisticsChart and implements the preparaData()
 * method to get the desired data from the REST client
 * object.
 *
 * \author seidel
 */
class TodayChart extends StatisticsChart
{
  /**
   * Parameterized constructor creates a new chart with
   * today's data and sets the chart title accordingly.
   */
  public function __construct($contentType)
  {
    parent::__construct($contentType);

    $this->chartTitle = 'Heute';
  }

  /**
   * Create a data object and use REST client to populate
   * it with information from remote server.
   */
  protected function prepareData($client)
  {
    $data = new pData();

    // Get today's data from REST client
    $todayData = $client->getData('today');

    // Extract values (e.g. number of reports)
    $values = array();
    for ($i = 0; $i < count($todayData); $i++)
    {
      $values[] = $todayData[$i]['ReportsCounter'];
    }

    // Set values and name of series (for legend)
    $data->addPoints($values, $this->contentTypeName);

    // Set label of Y axis
    $data->setAxisName(0, 'Anzahl');

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
