<?php

require_once('StatisticsChart.php');
require_once('DateTimeHelper.php');

/**
 * Class to draw a statistics chart with data of the
 * current week. This class is a child of the abstract
 * base class StatisticsChart and implements the
 * preparaData() method to get the desired data from
 * the REST client object.
 *
 * \author seidel
 */
class WeekChart extends StatisticsChart
{
  /**
   * Parameterized constructor creates a new chart with
   * data of the current week and sets the chart title
   * accordingly.
   */
  public function __construct($contentType)
  {
    parent::__construct($contentType);

    $this->chartTitle = '7 Tage';
  }

  /**
   * Create a data object and use REST client to populate
   * it with information from remote server.
   */
  protected function prepareData($client)
  {
    $data = new pData();

    // Get data of current week from REST client
    $currentWeekData = $client->getData('week');

    // Extract values (e.g. number of reports)
    $values = array();
    for ($i = 0; $i < count($currentWeekData); $i++)
    {
      $values[] = $currentWeekData[$i]['ReportsCounter'];
    }

    // Set values and name of series (for legend)
    $data->addPoints($values, $this->contentTypeName);

    // Set label of Y axis
    $data->setAxisName(0, 'Anzahl');

    // Extract labels for X axis
    $labels = array();
    for ($i = 0; $i < count($currentWeekData); $i++)
    {
      // TODO: Extract day of week
      // Format in data array is: YYYY-mm-dd
      // We cut it down to: nameOf(dd)
      $day = substr($currentWeekData[$i]['Week'], 8, 2);

      $labels[] = DateTimeHelper::germanNameOfDay($day, true);
    }

    // Assign labels to X axis
    $data->addPoints($labels, 'Labels');
    $data->setSerieDescription('Labels', 'Tage');
    $data->setAbscissa('Labels');
    $data->setAbscissaName('Tage');

    return $data;
  }
}

?>
