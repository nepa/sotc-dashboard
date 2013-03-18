/**
 * Application-specific JavaScript bootstrap code.
 */

// Load live chart for the very first time
refreshImage('chart.php?type=noiseLevels&mode=today');

// Create tabs for each block
$(document).ready(function () {
    $('div#block-noiseLevels').myTabs();
    $('div#block-soundSamples').myTabs();
    $('div#block-deviceInfos').myTabs();
    $('div#block-uniqueUsers').myTabs();
});

// Show statistics charts, when all images are loaded
$(window).load(function() {
    $('img.chart').fadeIn(700);
    $('div.tabs-content').css('background-image', 'none');
});
