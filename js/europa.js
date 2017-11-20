/**
 * @file
 * JS file for Europa theme.
 */

(function ($, Drupal) {
  Drupal.europa = Drupal.europa || {};
  Drupal.europa.breakpoints = Drupal.europa.breakpoints || {};

  // TODO:
  // Populate the breakpoints with those coming from Breakpoints module.
  // @see breakpoints js module for potential solution.
  Drupal.europa.breakpoints.medium = 'screen and (min-width: 480px)';
  Drupal.europa.breakpoints.small = 'screen and (min-width: 768px)';

  Drupal.behaviors.toggle_reset_button_if_required = {
    attach: function (context) {
      $(document).delegate('body', 'toggleResetButtonIfRequired', function (event, data) {
        if ($('.filters__facet-tag').length) {
          $('.js-showonsubmit').show();
        }
        else {
          $('.js-showonsubmit').hide();
        }
      });
    }
  };

  // This is for fixing the automatic zoom in IOS.
  Drupal.behaviors.noZoom = {
    attach: function (context) {
      $('select:first').once(function () {
        $('meta[name=viewport]').remove();
        $('head').append('<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=0">');
      });
    }
  };

  Drupal.behaviors.clampline = {
    attach: function (context) {
      $('.mediagallery__caption').clamp();
    }
  };

  Drupal.behaviors.timeline = {
    attach: function (context) {
      $('.timeline').once('timeline', function () {
        // Add the expander functionality only if necessary.
        if ($(this).data('expander-disable') != 1) {
          var $timelineItem = $('.timeline__list__item'),
              timelineItemsCount = $timelineItem.length,
              timeLineButton = '<button class="btn btn-timeline">' + Drupal.t('Show all timeline') + '</button>';

          if (timelineItemsCount > 5) {
            $('.timeline').append(timeLineButton);
            $timelineItem.each(function (ind) {
              if (ind > 4) {
                $(this).addClass('hidden');
              }
            });

            $('.btn-timeline', this).click(function (event) {
              event.preventDefault();
              $(this).hide();
              $timelineItem.removeClass('hidden');
              // Refreshing scrollspy to recalculate the offset.
              $('body').scrollspy('refresh');
            });
          }
        }
      });
    }
  };

  Drupal.behaviors.equal_blocks = {
    attach: function (context) {
      $('.equal-height').once('equal-height-blocks', function () {
        var $equal_height_block = $(this);
        if (typeof enquire !== 'undefined') {
          // Runs on device width change.
          enquire.register(Drupal.europa.breakpoints.small, {
            // Desktop.
            match : function () {
              Drupal.behaviors.equal_blocks.fixBlockHeights($equal_height_block, false);
            },
            // Mobile.
            unmatch : function () {
              Drupal.behaviors.equal_blocks.fixBlockHeights($equal_height_block, true);
            }
          });
        }
      });
    },

    fixBlockHeights: function ($block, stop) {
      $block.each(function () {
        var $wrapper = $(this),
            $blocks = [],
            i, max;

        // Columns and rows.
        if ($wrapper.hasClass('listing__wrapper--two-columns') || $wrapper.hasClass('listing__wrapper--row-two') || $wrapper.hasClass('listing__wrapper--row-three')) {
          var selector = '.listing__item-link > :first-child',
              $first_column = '',
              $middle_column = '',
              $last_column = '';

          if ($wrapper.find('.highlighted-item__content').length > 0) {
            selector = '.listing__column-main  .highlighted-item__content';
          }

          // Two column listing blocks.
          if ($wrapper.hasClass('listing__wrapper--two-columns')) {
            $first_column = $wrapper.find('.listing:first-child .listing__item');
            $last_column = $wrapper.find('.listing:last-child .listing__item');
          }
          // Row with two items.
          else if ($wrapper.hasClass('listing__wrapper--row-two')) {
            $first_column = $wrapper.find('.listing .listing__item:nth-child(odd)');
            $last_column = $wrapper.find('.listing .listing__item:nth-child(even)');
          }
          else if ($wrapper.hasClass('listing__wrapper--row-three')) {
            $first_column = $wrapper.find('.listing .listing__item:nth-child(3n-2)');
            $middle_column = $wrapper.find('.listing .listing__item:nth-child(3n+2)');
            $last_column = $wrapper.find('.listing .listing__item:nth-child(3n+3)');
          }

          // First column always contains more items if not equal.
          $first_column.each(function (index, item) {
            // Only applicable if there's an item in the other column at index.
            if (!$last_column.eq(index)) {
              return;
            }
            var $row = $(item).find(selector).add($last_column.eq(index).find(selector));
            // If we have a middle row, we add it as well.
            if ($middle_column !== '') {
              $row = $row.add($middle_column.eq(index).find(selector));
            }

            $blocks.push($row);
          });
        }
        // Simple listing blocks.
        else {
          $blocks.push($wrapper.find('.listing__item-link > :first-child'));
        }

        for (i = 0, max = $blocks.length; i < max; i++) {
          var $block = $blocks[i].equalHeight();
        }
      });
    }
  };

  Drupal.behaviors.europa_collapse = {
    attach: function (context) {
      Drupal.europa.collapsing();
    }
  };

  Drupal.europa.collapsing = function (show_text, hide_text) {
    if (!show_text) {
      show_text = Drupal.t('Show');
    }
    if (!hide_text) {
      hide_text = Drupal.t('Hide');
    }

    $('button[data-toggle=collapse]:not(.c-toggle)').each(function () {
      var $this = $(this),
          dependentId = $this.attr('data-target'),
          $arrow = $('.icon', $this),
          $fillMe = $('.toggling-text', $this),
          is_shown = $(dependentId).hasClass('in'),
          toggler_text = is_shown ? hide_text : show_text,
          icon_class = is_shown ? 'icon--up' : 'icon--down';

      $arrow.addClass(icon_class);
      $fillMe.text(toggler_text);

      $this.click(function (event) {
        toggler_text = $fillMe.text() == hide_text ? show_text : hide_text;
        if ($arrow.hasClass('icon--down')) {
          $arrow.removeClass('icon--down').addClass('icon--up');
        }
        else {
          $arrow.removeClass('icon--up').addClass('icon--down');
        }

        $fillMe.text(toggler_text);
      });
    });
  };

  var trackElements = [],
      errorEventSent = 'Piwik, trackEvent was not fired up.';

  /**
   * Acts like a wrapper for Piwik push method.
   *
   * For Piwik parameters refer to {@see https://developer.piwik.org/guides/tracking-javascript-guide}
   *
   * @param int {triggerValue}
   *   How many times should the call be triggered by page load
   *   Accepts 0,1 (0 for always and 1 just for one time).
   * @param str {action}
   *   Defines Action in piwik.
   * @param str {category}
   *   Defines category in piwik.
   * @param {value}
   *  Defines category in piwik.
   * @param {data}
   *  Defines category in piwik.
   */
  PiwikDTT = {
    sendTrack: function (triggerValue, action, category, value, data) {
      if (typeof action === "undefined" || action === null || action === '') {
        action = "trackEvent";
      }
      // Trigger only once.
      if (triggerValue == 1) {
        var innerElements = (triggerValue + action + category + value + data);
        if ($.inArray(innerElements, trackElements) === -1) {
          trackElements.push(innerElements);
          if (typeof _paq != 'undefined') {
            _paq.push([action, category, value, data]);
          }
        }
      }
      // Always trigger.
      if (triggerValue === 0) {
        if (typeof _paq != 'undefined') {
          _paq.push([action, category, value, data]);
        }
      }
    }
  };
})(jQuery, Drupal);
