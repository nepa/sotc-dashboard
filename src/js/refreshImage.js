/**
 * JavaScript to refresh live image via AJAX.
 */

function refreshImage(url)
{
  // Select img by id
  var $img = $('#live');

  // Preload image to prevent flickering
  var $loader = $(document.createElement('img'));
  $loader.one('load', function() {
    $img.attr('src', $loader.attr('src'));
  });

  // Append timestamp to prevent problems with caching
  var timestamp = new Date().getTime();
  $loader.attr('src', url + '&' + timestamp);

  // Show new image when loaded
  if ($loader.complete) {
    $loader.trigger('load');
  }

  // Refresh image every 3 seconds
  window.setTimeout('refreshImage(\'' + url + '\')', 3000);
}
