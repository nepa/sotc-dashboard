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

  <script src="js/ajaxRender.js" type="text/javascript"></script>
  <script src="js/myTabs.js" type="text/javascript"></script>
  <script src="js/bootstrap.js" type="text/javascript"></script>
</head>

<body>
  <h2 class="headline centered">Sound of the City</h2>
  <h3 class="sub-headline centered">Dashboard</h3>

  <div id="page-content">

    <h3 class="paragraph-headline">Live-Statistik</h3>

    <div class="content-always">
      <div id="myDiv"><!-- AJAX will insert image here. --></div>
    </div>

    <h3 class="paragraph-headline">Geräuschmessungen</h3>

    <div id="block-noiseLevels">
      <ul class="tabs">
          <li><a href="#">Heute</a></li>
          <li><a href="#">12 Monate</a></li>
      </ul>

      <div class="content">
          <div><img class="chart" src="chart.php?type=noiseLevels&amp;mode=today" alt="Ger&auml;schmessungen heute" /></div>
          <div><img class="chart" src="chart.php?type=noiseLevels&amp;mode=last-months" alt="Ger&auml;schmessungen der letzten 12 Monate" /></div>
      </div>
    </div>

    <h3 class="paragraph-headline">Audioaufnahmen</h3>

    <div id="block-soundSamples">
      <ul class="tabs">
          <li><a href="#">Heute</a></li>
          <li><a href="#">12 Monate</a></li>
      </ul>

      <div class="content">
          <div><img class="chart" src="chart.php?type=soundSamples&amp;mode=today" alt="Audioaufnahmen heute" /></div>
          <div><img class="chart" src="chart.php?type=soundSamples&amp;mode=last-months" alt="Audioaufnahmen der letzten 12 Monate" /></div>
      </div>
    </div>

    <h3 class="paragraph-headline">Geräteinformationen</h3>

    <div id="block-deviceInfos">
      <ul class="tabs">
          <li><a href="#">Heute</a></li>
          <li><a href="#">12 Monate</a></li>
      </ul>

      <div class="content">
          <div><img class="chart" src="chart.php?type=deviceInfos&amp;mode=today" alt="Ger&auml;teinformationen heute" /></div>
          <div><img class="chart" src="chart.php?type=deviceInfos&amp;mode=last-months" alt="Ger&auml;teinformationen der letzten 12 Monate" /></div>
      </div>
    </div>

    <h3 class="paragraph-headline">Individuelle Nutzer</h3>

    <div id="block-uniqueUsers">
      <ul class="tabs">
          <li><a href="#">Heute</a></li>
          <li><a href="#">12 Monate</a></li>
      </ul>

      <div class="content">
          <div><img class="chart" src="chart.php?type=uniqueUsers&amp;mode=today" alt="Individuelle Nutzer heute" /></div>
          <div><img class="chart" src="chart.php?type=uniqueUsers&amp;mode=last-months" alt="Individuelle Nutzer der letzten 12 Monate" /></div>
      </div>
    </div>

  </div>

  <div id="footer">Copyright &copy; 2013: <strong>Institut f&uuml;r Telematik</strong>, Universit&auml;t zu L&uuml;beck</div>
</body>

</html>
