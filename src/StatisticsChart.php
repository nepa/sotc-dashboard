<?php

require_once('SummaryClient.php');

require_once('pChart/class/pData.class.php');
require_once('pDraw.custom.php');
require_once('pChart/class/pImage.class.php');

/**
 * Abstract base class for all child classes that can draw
 * statistical charts dynamically. This class will issue a
 * REST request to the remote server and store the response
 * locally. Furthermore, the class provides a function to
 * draw charts. The data preparation is done individually
 * in each of the child classes.
 *
 * \author seidel
 */
abstract class StatisticsChart
{
  /** REST client for connection to remote server */
  private $client;

  /** Data object for chart */
  private $data;

  /** Image object to draw picture with pChart library */
  private $image;

  /** Text for small title on top of picture */
  protected $pictureTitle;

  /** Text for big title on chart */
  protected $chartTitle;

  /** Human readable content type */
  protected $contentTypeName;

  /**
   * Parameterized constructor to initialize a new statistics
   * chart for the desired content type.
   *
   * The constructor will fetch all necessary data from the
   * remote server, prepare it for the chart and will finally
   * create the image object to be drawn.
   */
  public function __construct($contentType = 'noiseLevels')
  {
    // Set title of entire picture
    $this->pictureTitle = 'Sound of the City - Zugriffsstatistik';

    // Set human readable content type
    $this->contentTypeName = $this->mapContentType($contentType);

    // Connect to remote server and fetch data
    $this->client = new SummaryClient($contentType);
    $this->client->refreshStatistics();

    // Parse data from remote server
    $this->data = $this->prepareData($this->client);

    // Create image object
    $this->image = new pImage(700, 230, $this->data);
  }

  /**
   * Create a data object and use REST client to populate
   * it with information from remote server.
   */
  protected abstract function prepareData($client);

  /**
   * Draw the statistics chart and send it to the browser.
   * The browser can either show the image directly or
   * embed it in an img-tag.
   */
  public function drawChart()
  {
    $picture = $this->image;

    // Turn of antialiasing
    $picture->Antialias = false;

    // Add border to picture
    $picture->drawGradientArea(0, 0, 700, 230, DIRECTION_VERTICAL,
      array('StartR' => 240, 'StartG' => 240, 'StartB' => 240,
            'EndR' => 180, 'EndG' => 180, 'EndB' => 180, 'Alpha' => 100));

    $picture->drawGradientArea(0, 0, 700, 230, DIRECTION_HORIZONTAL,
      array('StartR' => 240, 'StartG' => 240, 'StartB' => 240,
            'EndR' => 180, 'EndG' => 180, 'EndB' => 180, 'Alpha' => 20));

    $picture->drawRectangle(0, 0, 699, 229, array('R' => 0, 'G' => 0, 'B' => 0));

    // Set default font
    $fontSettings = array('FontName' => 'pChart/fonts/pf_arma_five.ttf', 'FontSize' => 6);
    $picture->setFontProperties($fontSettings);

    // Define chart area
    $picture->setGraphArea(60, 40, 650, 200);

    // Draw the scale
    $scaleSettings = array(
      'GridR' => 200, 'GridG' => 200, 'GridB' => 200,
      'DrawSubTicks' => true, 'CycleBackground' => true, 'Mode' => SCALE_MODE_START0);
    $picture->drawScale($scaleSettings);

    // Draw the legend
    $legendStyle = array('Style' => LEGEND_NOBORDER, 'Mode' => LEGEND_HORIZONTAL);
    $picture->drawLegend(480, 15, $legendStyle);

    // Create shadow effect
    $picture->setShadow(true, array('X' => 1, 'Y' => 1, 'R' => 0, 'G' => 0, 'B' => 0, 'Alpha' => 10));

    // Draw title of picture
    $fontSettings = array(
      'FontName' => 'pChart/fonts/Silkscreen.ttf', 'FontSize' => 6,
      'R' => 0, 'G' => 0, 'B' => 0);
    $picture->drawText(10, 13, $this->pictureTitle, $fontSettings);

    // Draw title of chart
    $fontSettings = array('FontSize' => 14, 'Align' => TEXT_ALIGN_BOTTOMMIDDLE);
    $picture->drawText(350, 30, $this->chartTitle, $fontSettings);

    // Draw the entire chart
    $chartSettings = array('DisplayValues' => true, 'Surrounding' => -30, 'InnerSurrounding' => 30);
    $picture->drawBarChart($chartSettings);

    // Render picture and send it to webbrowser
    //
    //   autoOutput: Either create image file
    //               or embed in website
    $picture->autoOutput('SotC-UseStatistics.png');
  }

  /**
   * Map all known content types to their human readable
   * equivalent, so that it can be used in the chart.
   *
   * Right now, valid types are:
   *   - noiseLevels
   *   - soundSamples
   *   - deviceInfos
   *   - uniqueUsers
   *   - appDownloads
   */
  protected function mapContentType($contentType)
  {
    $result = '';

    switch ($contentType)
    {
      case 'noiseLevels':
        $result = 'Geräuschmessungen';
        break;
      case 'soundSamples':
        $result = 'Audioaufnahmen';
        break;
      case 'deviceInfos':
        $result = 'Geräteinformationen';
        break;
      case 'uniqueUsers':
        $result = 'Individuelle Nutzer';
        break;
      case 'appDownloads':
        $result = 'App Downloads';
        break;
      default:
        die('<p><b>Error:</b> Cannot map invalid content type.</p>');
        break;
    }

    return $result;
  }
}

?>
