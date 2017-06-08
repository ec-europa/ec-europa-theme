jQuery(function () {
  jQuery(document).ready(function () {
    var $datepicker = jQuery('#datepicker');

    $datepicker.datepicker({
      changeMonth: true,
      changeYear: true
    });

    jQuery(window).resize(function () {
      $datepicker.datepicker('hide');
    });
  });
});
