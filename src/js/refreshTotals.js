/**
 * JavaScript to refresh 'Total' tabs via AJAX.
 */

function refreshTotals()
{
  // Issue REST request
  $.ajax(
  {
    type: 'GET',
    url: 'TotalsClient.php',
    success: function(data) {
      var response = $.parseJSON(data);

      // Schema for counter element names:
      //
      //   Span id in index.html:
      //     e.g. counter-noiseLevels
      //
      //   JSON key in REST response:
      //     e.g. NoiseLevelsCounter
      var counter = new Array();
      counter['noiseLevels'] = 'NoiseLevelsCounter';
      counter['soundSamples'] = 'SoundSamplesCounter';
      counter['deviceInfos'] = 'DeviceInfosCounter';
      counter['uniqueUsers'] = 'UniqueUsersCounter';

      // Update all counters
      for (var key in counter)
      {
        var oldValue = $('#counter-' + key).text();
        var newValue = response[counter[key]];

        // Only update counter, if value changed
        if (oldValue != newValue)
        {
          $('#counter-' + key).text(newValue);
        }
      }
    }
  });

  // Refresh totals every 3 seconds
  window.setTimeout('refreshTotals()', 3000);
}
