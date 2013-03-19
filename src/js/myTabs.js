 /**
  * jQuery plug-in for multiple tabbed areas on one page.
  *
  * A default selected tab can be provided via URL parameter:
  *
  *   http://example.com?default=2
  */

(function ($) {
  $.fn.myTabs = function (options) {
    options = $.extend({
      'tabSelectedClass': 'current', // Name of class that is added to current tag
      'queryName': 'default' // Name of URL parameter for default tab
    }, options);

    return this.each(function () {

      /**
       * Cache selectors to minimize amount of DOM queries.
       */
      var base = this;
      var tabSelectedClass = options.tabSelectedClass;
      var $base = $(this);
      var $tabContainer = $base.find('.tabs');
      var $tabs = $tabContainer.find('li');
      var $tabContentContainer = $base.find('.tabs-content');
      var $tabContent = $tabContentContainer.find(' > div');

      /**
       * Initialize the tabs plug-in.
       */
      this.init = function () {
        var _tabUrlIndex = parseFloat(base.getTabFromUrl()) - 1;
        var _startIndex = _tabUrlIndex || 0;

        base.showContent(_startIndex);
        $tabs.find('a').on('click.myTabs', base.handleTabClick);
      };

      /**
       * Get index of default tab from URL parameter (if any).
       */
      this.getTabFromUrl = function () {
        var _currentUrl = window.location.href;
        var _params = _currentUrl.slice(_currentUrl.indexOf('?') + 1).split('&');
        var i = 0;
        var _paramsLength = _params.length;
        var _value = '';

        for (i; i < _paramsLength; i++)
        {
          _value = _params[i].split('=');

          if (_value[0] === options.queryName)
          {
            return _value[1];
          }
        }

        return undefined;
      };

      /**
       * Catch tab click and gather the selected tab's index.
       */
      this.handleTabClick = function (e) {
        var _tabIndex = $(this).parent('li').index();

        base.showContent(_tabIndex);
        e.preventDefault();
      };

      /**
       * Show tab content and highlight tab with current index.
       */
      this.showContent = function (index) {
        $tabs.find('a').filter(function () {
          return $(this).hasClass(tabSelectedClass);
        }).removeClass(tabSelectedClass);

        $tabContent.filter(function () {
          return $(this).index() !== index;
        }).hide();

        $tabs.eq(index).find('a').addClass(tabSelectedClass);
        $tabContent.eq(index).fadeIn();
      };

      this.init();
    });
  };
}(jQuery));
