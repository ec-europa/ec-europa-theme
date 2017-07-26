/**
 * @file
 * Table responsive related behaviors.
 */

(function ($) {
  Drupal.behaviors.europa_table = {
    attach: function (context) {
      $('.table-responsive').each(function () {
        var headerText = [],
          // The rows in a table body.
          tableRows = $('tbody tr', $(this)),
          // The headers in a table.
          headers = $('thead tr th', $(this)),
          // The number of main headers.
          headFirst = $('thead tr:first th', $(this)).length - 1,
          // Number of cells per row.
          cellPerRow = $('tbody tr:first td', $(this)).length,
          // Position of the eventual colspan element.
          colspanIndex = $('th[colspan]', $(this)).index();

        // Build the array with all the "labels".
        for (var i = 0; i < headers.length; i++) {
          headerText[i] = [];
          headerText[i] = headers[i].textContent;
        }

        // If we have a colspan, we have to prepare the data for it.
        if (colspanIndex !== -1) {
          var textColspan = headerText.splice(colspanIndex, 1),
            ci = colspanIndex,
            cn = $('th[colspan]', $(this)).attr('colspan');

          for (var c = 0; c < cn; c++) {
            headerText.splice(ci + c, 0, headerText[headFirst + c]);
            headerText.splice(headFirst + 1 + c, 1);
          }
        }

        // For every row, set the attributes we use to make this happen.
        tableRows.each(function () {
          for (var j = 0; j < cellPerRow; j++) {
            if (headerText[j] == '' || headerText[j] == '\u00a0') {
              $('td', $(this)).eq(j).attr({
                "class": "table-responsive__heading"
              });
            }
            else {
              $('td', $(this)).eq(j).attr("data-th", headerText[j]);
            }

            if (colspanIndex !== -1) {
              $('td', $(this)).eq(colspanIndex).attr({
                "data-th-group": textColspan,
                "class": "table-responsive__group_label"
              });

              for (var c = 1; c < cn; c++) {
                $('td', $(this)).eq(colspanIndex + c).attr({
                  "class": "table-responsive__group_element"
                });
              }
            }
          }
        });
      });
    }
  };
})(jQuery);
