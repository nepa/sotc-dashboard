<!DOCTYPE html>
<html>

<head>
  <title>Sound of the City &ndash; Dashboard</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <script>
    ajaxRender('myDiv', 'chart.php?type=noiseLevels&mode=today');

    function ajaxRender(DivID, URL)
    {
      var xmlhttp = false;

      /*@cc_on @*/
      /*@if (@_jscript_version >= 5)
        try {
          xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e)
        {
          try
          {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          catch (E)
          {
            xmlhttp = false;
          }
        }
      @end @*/

      if (!xmlhttp && typeof XMLHttpRequest != 'undefined')
      {
        try
        {
          xmlhttp = new XMLHttpRequest();
        }
        catch (e)
        {
          xmlhttp=false;
        }
      }

      if (!xmlhttp && window.createRequest)
      {
        try
        {
          xmlhttp = window.createRequest();
        }
        catch (e)
        {
          xmlhttp=false;
        }
      }

      xmlhttp.open("GET", URL, true);

      xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4)
        {
          var timestamp = new Date().getTime();
          var chartURL = URL + '&' + timestamp;

          // Preload image to prevent flickering
          var image = new Image();
          image.src = chartURL;

          // Display image after 2 second time
          window.setTimeout("showImage('" + DivID + "', '" + chartURL + "')", 2000);
        }
      }

      xmlhttp.send(null)

      // Reload image after 3 seconds
      window.setTimeout("ajaxRender('myDiv', 'chart.php?type=noiseLevels&mode=today')", 3000);
    }

    function showImage(DivID, URL)
    {
      document.getElementById(DivID).innerHTML="<img src='" + URL + "'/>";
    }
  </script>

  <style type="text/css">
    body {
      font-family: Arial, Helvetica, sans-serif;

      background-image: url('data:image/png;base64,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');
    }

    div#content {
      width: 85%;

      margin: 0 auto;
      padding: 10px;
      padding-left: 30px;

      background-color: #FFFFFF;
      border: 1px solid #000000;
      border-radius: 5px;

      box-shadow: 5px 5px 5px #CCCCCC;
    }

    div#footer {
      margin-top: 25px;
      margin-bottom: 25px;

      font-size: 12px;
      text-align: center;
    }

    .centered {
      text-align: center;
    }

    @font-face {
      font-family: 'ChunkFive-Regular';
      src: url('./fonts/ChunkFive-Regular.eot') format('eot'),
           url('./fonts/ChunkFive-Regular.otf') format('opentype'),
           url('./fonts/ChunkFive-Regular.woff') format('woff');
      font-weight: normal;
      font-style: normal;
    }

    h2, h3, h4 {
      margin: 0;
      padding: 0;

      font-family: Arial, Helvetica, sans-serif;
      font-weight: normal;
      color: #292929;
    }

    h2.headline {
      margin-bottom: 10px;

      font-family: 'ChunkFive-Regular', Arial, Helvetica, sans-serif;
      font-size: 72px;
      text-transform: uppercase;
      text-shadow: 0px 3px 3px #555555;
    }

    h3.sub-headline {
      margin-bottom: 30px;

      font-size: 32px;
      text-shadow: 0px 1px 2px #555555;
    }

    h3.paragraph-headline {
      margin-top: 30px;
      margin-bottom: 10px;

      font-size: 24px;
      text-shadow: 0px 1px 2px #555555;
    }

    h4.paragraph-sub-headline {
      margin-top: 10px;
      margin-bottom: 5px;

      font-size: 18px;
      text-shadow: 0px 1px 1px #555555;
    }
  </style>
</head>

<body>
  <h2 class="headline centered">Sound of the City</h2>
  <h3 class="sub-headline centered">Dashboard</h3>

  <div id="content">

    <h3 class="paragraph-headline">Live-Statistik</h3>

    <div id='myDiv' style="width: 700px; height: 230px;">Fetching data...</div>

    <h3 class="paragraph-headline">Geräuschmessungen</h3>

    <div id='chart'><img src="chart.php?type=noiseLevels&mode=last-months" alt="Ger&auml;schmessungen" /></div>

    <h3 class="paragraph-headline">Audioaufnahmen</h3>

    <div id='chart'><img src="chart.php?type=soundSamples&mode=last-months" alt="Ger&auml;schmessungen" /></div>

    <h3 class="paragraph-headline">Geräteinformationen</h3>

    <div id='chart'><img src="chart.php?type=deviceInfos&mode=last-months" alt="Ger&auml;schmessungen" /></div>

    <h3 class="paragraph-headline">Individuelle Nutzer</h3>

    <div id='chart'><img src="chart.php?type=uniqueUsers&mode=last-months" alt="Ger&auml;schmessungen" /></div>

    <h3 class="paragraph-headline">App Downloads</h3>

    <div id='chart'><img src="chart.php?type=appDownloads&mode=last-months" alt="Ger&auml;schmessungen" /></div>

  </div>

  <div id="footer">Copyright &copy; 2013: <strong>Institut f&uuml;r Telematik</strong>, Universit&auml;t zu L&uuml;beck</div>
</body>

</html>
