/**
 * @file
 * This will add the arrow to the select list.
 */

window.addEventListener("DOMContentLoaded", function () {
  var elements = document.getElementsByClassName("form-type-select");

  for (var ind in elements) {
    if (elements.hasOwnProperty(ind)) {
      elements[ind].innerHTML += '<span class="select-list-arrow"></span>';
    }
  }
}, false);
