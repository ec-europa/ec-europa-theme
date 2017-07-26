/**
 * @file
 * Library converting 'ul > li > a' list to 'select > option' list.
 */

'use strict';

(function ($) {
  /**
  * Standard jQuery plugin pattern. @see {@link http://learn.jquery.com/plugins/basic-plugin-creation/}.
  */
  $.fn.selectify = function (options) {
    this.each(function () {
      // Defaults settings.
      var settings = $.extend({
        listWrapper: $(this),
        listSelector: 'element__list',
        item: 'element__option',
        other: 'element__other',
        unavailable: 'element__unavailable',
        selected: 'is-selected'
      }, options);
      // Private methods.
      var attachDropDown = function () {
        var listClass = settings.listSelector,
        $list = $('ul.' + listClass);

        // For every list which the user wants to convert.
        $list.each(function () {
          // Start building the select and keep the same class as the ul.
          var $select = $('<select />').addClass(listClass);
          // For each element of the particular ul.
          $list.find('li.' + settings.item).each(function () {
            var currentClass = $(this).attr('class');
            switch (currentClass) {
              // Skip if it's unavailable.
              case String(settings.item + ' ' + settings.unavailable):
                break;

              // Build an option element, selected state.
              case String(settings.item + ' ' + settings.selected):
                var $option = $('<option />');
                $option.html($(this).html()).attr('selected', true);
                $select.append($option);
                break;

              // Build a regular option element.
              case String(settings.item + ' ' + settings.other):
                var $option = $('<option />'),
                  $this = $(this),
                  optionTarget = $this.find('a').attr('href'),
                  optionLabel = $this.text();

                $option.attr({
                  'value': optionTarget,
                  'lang': $this.find('a').attr('lang')
                }).text(optionLabel);
                $select.append($option);
                break;
            }
          });
          // Add the select to the DOM. Only if it's not already added.
          if (!$list.parent().find('select').length) {
            $list.parent().append($select);
            settings.listWrapper.find('select').hide();
            // Listener to change the URL of the page depending on the target.
            $select.on({
              change: function () {
                var target = String($(this).val());
                window.location.href = $("a[href='" + target + "']").first().attr('href');
              }
            });
          }
        });
      };
      var hideDropDown = function () {
        settings.listWrapper.find('select' + '.' + settings.listSelector).hide();
      };
      var hideList = function () {
        var $list = settings.listWrapper.find('ul.' + settings.listSelector);
        $list.children('.lang-select-page__other').hide();
        $list.children('.is-selected').hide();
      };
      var showDropDown = function () {
        settings.listWrapper.find('select' + '.' + settings.listSelector).show();
      };
      var showList = function () {
        var $list = settings.listWrapper.find('ul.' + settings.listSelector);
        $list.children('.lang-select-page__other').show();
        $list.children('.is-selected').show();
      };
      // Custom event handlers, scoped to the context of the instance.
      settings.listWrapper.on('hide.dropdown', hideDropDown);
      settings.listWrapper.on('hide.list', hideList);
      settings.listWrapper.on('show.dropdown', showDropDown);
      settings.listWrapper.on('show.list', showList);
      // Could be placed under init() method to be controlled by user.
      attachDropDown();
    });
  };

})(jQuery);
