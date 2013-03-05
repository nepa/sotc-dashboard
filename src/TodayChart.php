<?php

require_once('StatisticsChart.php');

class TodayChart extends StatisticsChart
{
  // TODO: Implement class properly

  public function __construct($contentType)
  {
    parent::__construct($contentType);

    $this->pictureTitle = 'Sound of the City - Use statistics';
    $this->chartTitle = 'Last 12 months';
  }

  /**
   * Create a data object and use REST client to populate
   * it with information from remote server.
   */
  protected function prepareData($client)
  {
    $data = new pData();

    // TODO: Remove block
    $numbers = array();
    for ($i = 0; $i < 12; $i++) {
      $numbers[] = rand(10, 250);
    }
    $data->addPoints($numbers, 'Noise Levels');

// TODO:
//  $data->addPoints($client->getData('last-months'), 'Noise Levels');
//  $data->setAxisName(0, 'Meldungen');

    $monthLabels = array(
      'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September',
      'Oktober', 'November', 'Dezember', 'Januar', 'Februar');

    $data->addPoints($monthLabels, 'Monate');
    $data->setSerieDescription('Monate', 'Monat');
    $data->setAbscissa('Monate');

    return $data;
  }
}

?>
