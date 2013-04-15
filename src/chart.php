<?php

/**
 * Proxy to draw charts with use statistics.
 */

require_once('LiveChart.php');
require_once('TodayChart.php');
require_once('WeekChart.php');
require_once('LastMonthsChart.php');

// Validate URL arguments
if (isset($_GET['mode']) && $_GET['mode'] == 'live')
{
  // Create and draw live chart
  $chart = new LiveChart();
  $chart->drawChart();
}
else if (isset($_GET['mode']) && isset($_GET['type']))
{
  $mode = $_GET['mode'];
  $type = $_GET['type'];
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
  die('<p><b>Error:</b> Invalid or missing arguments. Set mode and/or type.</p>');
}

?>
