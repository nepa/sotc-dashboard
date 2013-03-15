/**
 * JavaScript to load images via AJAX.
 */

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
