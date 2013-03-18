<!DOCTYPE html>
<html>

<head>
  <title>Sound of the City &ndash; Dashboard</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <link rel="stylesheet" type="text/css" media="all" href="css/style.css" />
  <link rel="stylesheet" type="text/css" media="all" href="css/tabs.css" />

  <!-- Load jQuery via Google CDN -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
  <!-- Local fallback, in case CDN fails -->
  <script>window.jQuery || document.write('<script src="js/jquery-1.9.1.min.js" type="text/javascript"><\/script>')</script>

  <script src="js/refreshImage.js" type="text/javascript"></script>
  <script src="js/myTabs.js" type="text/javascript"></script>
  <script src="js/bootstrap.js" type="text/javascript"></script>
</head>

<body>
  <div id="header">
    <div id="logo">&nbsp;</div>

    <div id="title"><span class="dark">.dash</span><span class="light">board</span></div>
  </div>
  <div style="clear: both;"></div>

  <div id="content">

    <h3>Live-Statistik</h3>

    <div class="tabs-content-always">
      <div><img id="live" class="chart" src="#" alt="Live-Statistik" /></div>
    </div>

    <h3>Ger&auml;uschmessungen</h3>

    <div id="block-noiseLevels">
      <ul class="tabs">
          <li><a href="#">Heute</a></li>
          <li><a href="#">7 Tage</a></li>
          <li><a href="#">12 Monate</a></li>
          <li><a href="#">Total</a></li>
      </ul>

      <div class="tabs-content">
          <div><img class="chart" src="chart.php?type=noiseLevels&amp;mode=today" alt="Ger&auml;schmessungen heute" /></div>
          <div>TODO</div>
          <div><img class="chart" src="chart.php?type=noiseLevels&amp;mode=last-months" alt="Ger&auml;schmessungen der letzten 12 Monate" /></div>
          <div>TODO</div>
      </div>
    </div>

    <h3>Audioaufnahmen</h3>

    <div id="block-soundSamples">
      <ul class="tabs">
          <li><a href="#">Heute</a></li>
          <li><a href="#">7 Tage</a></li>
          <li><a href="#">12 Monate</a></li>
          <li><a href="#">Total</a></li>
      </ul>

      <div class="tabs-content">
          <div><img class="chart" src="chart.php?type=soundSamples&amp;mode=today" alt="Audioaufnahmen heute" /></div>
          <div>TODO</div>
          <div><img class="chart" src="chart.php?type=soundSamples&amp;mode=last-months" alt="Audioaufnahmen der letzten 12 Monate" /></div>
          <div>TODO</div>
      </div>
    </div>

    <h3>Ger&auml;teinformationen</h3>

    <div id="block-deviceInfos">
      <ul class="tabs">
          <li><a href="#">Heute</a></li>
          <li><a href="#">7 Tage</a></li>
          <li><a href="#">12 Monate</a></li>
          <li><a href="#">Total</a></li>
      </ul>

      <div class="tabs-content">
          <div><img class="chart" src="chart.php?type=deviceInfos&amp;mode=today" alt="Ger&auml;teinformationen heute" /></div>
          <div>TODO</div>
          <div><img class="chart" src="chart.php?type=deviceInfos&amp;mode=last-months" alt="Ger&auml;teinformationen der letzten 12 Monate" /></div>
          <div>TODO</div>
      </div>
    </div>

    <h3>Individuelle Nutzer</h3>

    <div id="block-uniqueUsers">
      <ul class="tabs">
          <li><a href="#">Heute</a></li>
          <li><a href="#">7 Tage</a></li>
          <li><a href="#">12 Monate</a></li>
          <li><a href="#">Total</a></li>
      </ul>

      <div class="tabs-content">
          <div><img class="chart" src="chart.php?type=uniqueUsers&amp;mode=today" alt="Individuelle Nutzer heute" /></div>
          <div>TODO</div>
          <div><img class="chart" src="chart.php?type=uniqueUsers&amp;mode=last-months" alt="Individuelle Nutzer der letzten 12 Monate" /></div>
          <div>TODO</div>
      </div>
    </div>

  </div>

  <div id="footer">Copyright &copy; 2013: <strong>Institut f&uuml;r Telematik</strong>, Universit&auml;t zu L&uuml;beck</div>
</body>

</html>
