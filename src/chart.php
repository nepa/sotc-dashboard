<?php

/**
 * Proxy to draw charts with use statistics.
 */

require_once('TodayChart.php');
require_once('WeekChart.php');
require_once('LastMonthsChart.php');

// Validate URL arguments
if (isset($_GET['type']) && isset($_GET['mode']))
{
  $type = $_GET['type'];
  $mode = $_GET['mode'];
  $chart = null;

  // Create chart for today
  if ($mode == 'today')
  {
    $chart = new TodayChart($type);
  }
  // Create chart for current week
  else if ($mode == 'week')
  {
    $chart = new WeekChart($type);
  }
  // Create chart for last months
  else if ($mode == 'last-months')
  {
    $chart = new LastMonthsChart($type);
  }
  else
  {
    die('<p><b>Error:</b> Invalid argument for mode.</p>');
  }

  // Draw chart
  $chart->drawChart();
}
else
{
  die('<p><b>Error:</b> Invalid or missing arguments. Set type and mode.</p>');
}

?>
