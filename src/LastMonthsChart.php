<?php

require_once('StatisticsChart.php');
require_once('DateTimeHelper.php');

/**
 * Class to draw a statistics chart with data of the
 * last twelve months. This class is a child of the
 * abstract base class StatisticsChart and implements
 * the preparaData() method to get the desired data
 * from the REST client object.
 *
 * \author seidel
 */
class LastMonthsChart extends StatisticsChart
{
  /**
   * Parameterized constructor creates a new chart with
   * data of the last twelve months and sets the chart
   * title accordingly.
   */
  public function __construct($contentType)
  {
    parent::__construct($contentType);

    $this->chartTitle = '12 Monate';
  }

  /**
   * Create a data object and use REST client to populate
   * it with information from remote server.
   */
  protected function prepareData($client)
  {
    $data = new pData();

    // Get data of last months from REST client
    $lastMonthsData = $client->getData('last-months');

    // Extract values (e.g. number of reports)
    $values = array();
    for ($i = 0; $i < count($lastMonthsData); $i++)
    {
      $values[] = $lastMonthsData[$i]['ReportsCounter'];
    }

    // Set values and name of series (for legend)
    $data->addPoints($values, $this->contentTypeName);

    // Set label of Y axis
    $data->setAxisName(0, 'Anzahl');

    // Extract labels for X axis
    $labels = array();
    for ($i = 0; $i < count($lastMonthsData); $i++)
    {
      // Format in data array is: YYYY-mm
      // We cut it down to: nameOf(mm) 'YY
      $month = substr($lastMonthsData[$i]['Month'], 5, 2);
      $year =  substr($lastMonthsData[$i]['Month'], 2, 2);

      $labels[] = DateTimeHelper::germanNameOf($month, true) . ' \'' . $year;
    }

    // Assign labels to X axis
    $data->addPoints($labels, 'Labels');
    $data->setSerieDescription('Labels', 'Monate');
    $data->setAbscissa('Labels');
    $data->setAbscissaName('Monate');

    return $data;
  }
}

?>
