var ECL = (function (exports) {
'use strict';

/**
 * `Node#contains()` polyfill.
 *
 * See: http://compatibility.shwups-cms.ch/en/polyfills/?&id=1
 *
 * @param {Node} node
 * @param {Node} other
 * @return {Boolean}
 * @public
 */

function contains(node, other) {
  // eslint-disable-next-line no-bitwise
  return node === other || !!(node.compareDocumentPosition(other) & 16);
}

const dropdown = selector => {
  const dropdownsArray = Array.prototype.slice.call(
    document.querySelectorAll(selector)
  );

  document.addEventListener('click', event => {
    dropdownsArray.forEach(dropdownSelection => {
      const isInside = contains(dropdownSelection, event.target);

      if (!isInside) {
        const dropdownButton = document.querySelector(
          `${selector} > [aria-expanded=true]`
        );
        const dropdownBody = document.querySelector(
          `${selector} > [aria-hidden=false]`
        );
        // If the body of the dropdown is visible, then toggle.
        if (dropdownBody) {
          dropdownButton.setAttribute('aria-expanded', false);
          dropdownBody.setAttribute('aria-hidden', true);
        }
      }
    });
  });
};

// const path = require("path");
// This logic for finding the path to the js files.
// const source_folder = __dirname + "/node_modules/@ec-europa";

// export * from "../../node_modules/@ec-europa/ecl-accordions/accordions";

// Good

// export * from "./components/ecl-expandables/expandables";

// export * from './components/ecl-files/files';
// export * from './components/ecl-filters/filters';
// export * from './components/ecl-forms/ecl-forms-file-uploads/ecl-forms-file-uploads';
// export * from './components/ecl-inpage-navs/inpage-navs';

// Good
// export * from "./components/ecl-messages/messages";
// export * from "./components/ecl-navigation/ecl-navigation-menus/megamenu";
// export * from "./components/ecl-tables/ecl-tables";
// export * from "./components/ecl-tabs/tabs";

// export * from './components/ecl-timelines/timelines';

exports.dropdown = dropdown;

return exports;

}({}));
