var ECL = (function (exports) {
'use strict';

// Query helper
var queryAll = function queryAll(selector) {
  var context = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : document;
  return [].slice.call(context.querySelectorAll(selector));
};

// Heavily inspired by the accordion component from https://github.com/frend/frend.co

/**
 * @param {object} options Object containing configuration overrides
 */
var accordions = function accordions() {
  var _ref = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {},
      _ref$selector = _ref.selector,
      selector = _ref$selector === undefined ? '.ecl-accordion' : _ref$selector,
      _ref$headerSelector = _ref.headerSelector,
      headerSelector = _ref$headerSelector === undefined ? '.ecl-accordion__header' : _ref$headerSelector;

  // SUPPORTS
  if (!('querySelector' in document) || !('addEventListener' in window) || !document.documentElement.classList) return null;

  // SETUP
  // set accordion element NodeLists
  var accordionContainers = queryAll(selector);

  // ACTIONS
  function hidePanel(target) {
    // get panel
    var activePanel = document.getElementById(target.getAttribute('aria-controls'));

    target.setAttribute('aria-expanded', 'false');

    // toggle aria-hidden
    activePanel.setAttribute('aria-hidden', 'true');
  }

  function showPanel(target) {
    // get panel
    var activePanel = document.getElementById(target.getAttribute('aria-controls'));

    // set attributes on header
    target.setAttribute('tabindex', 0);
    target.setAttribute('aria-expanded', 'true');

    // toggle aria-hidden and set height on panel
    activePanel.setAttribute('aria-hidden', 'false');
  }

  function togglePanel(target) {
    // close target panel if already active
    if (target.getAttribute('aria-expanded') === 'true') {
      hidePanel(target);
      return;
    }

    showPanel(target);
  }

  function giveHeaderFocus(headerSet, i) {
    // set active focus
    headerSet[i].focus();
  }

  // EVENTS
  function eventHeaderClick(e) {
    togglePanel(e.currentTarget);
  }

  function eventHeaderKeydown(e) {
    // collect header targets, and their prev/next
    var currentHeader = e.currentTarget;
    var isModifierKey = e.metaKey || e.altKey;
    // get context of accordion container and its children
    var thisContainer = currentHeader.parentNode.parentNode;
    var theseHeaders = queryAll(headerSelector, thisContainer);
    var currentHeaderIndex = [].indexOf.call(theseHeaders, currentHeader);

    // don't catch key events when ⌘ or Alt modifier is present
    if (isModifierKey) return;

    // catch enter/space, left/right and up/down arrow key events
    // if new panel show it, if next/prev move focus
    switch (e.keyCode) {
      case 13:
      case 32:
        togglePanel(currentHeader);
        e.preventDefault();
        break;
      case 37:
      case 38:
        {
          var previousHeaderIndex = currentHeaderIndex === 0 ? theseHeaders.length - 1 : currentHeaderIndex - 1;
          giveHeaderFocus(theseHeaders, previousHeaderIndex);
          e.preventDefault();
          break;
        }
      case 39:
      case 40:
        {
          var nextHeaderIndex = currentHeaderIndex < theseHeaders.length - 1 ? currentHeaderIndex + 1 : 0;
          giveHeaderFocus(theseHeaders, nextHeaderIndex);
          e.preventDefault();
          break;
        }
      default:
        break;
    }
  }

  // BIND EVENTS
  function bindAccordionEvents(accordionContainer) {
    var accordionHeaders = queryAll(headerSelector, accordionContainer);
    // bind all accordion header click and keydown events
    accordionHeaders.forEach(function (accordionHeader) {
      accordionHeader.addEventListener('click', eventHeaderClick);
      accordionHeader.addEventListener('keydown', eventHeaderKeydown);
    });
  }

  // UNBIND EVENTS
  function unbindAccordionEvents(accordionContainer) {
    var accordionHeaders = queryAll(headerSelector, accordionContainer);
    // unbind all accordion header click and keydown events
    accordionHeaders.forEach(function (accordionHeader) {
      accordionHeader.removeEventListener('click', eventHeaderClick);
      accordionHeader.removeEventListener('keydown', eventHeaderKeydown);
    });
  }

  // DESTROY
  function destroy() {
    accordionContainers.forEach(function (accordionContainer) {
      unbindAccordionEvents(accordionContainer);
    });
  }

  // INIT
  function init() {
    if (accordionContainers.length) {
      accordionContainers.forEach(function (accordionContainer) {
        bindAccordionEvents(accordionContainer);
      });
    }
  }

  init();

  // REVEAL API
  return {
    init: init,
    destroy: destroy
  };
};

// module exports

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

var dropdown = function dropdown(selector) {
  var dropdownsArray = Array.prototype.slice.call(document.querySelectorAll(selector));

  document.addEventListener('click', function (event) {
    dropdownsArray.forEach(function (dropdownSelection) {
      var isInside = contains(dropdownSelection, event.target);

      if (!isInside) {
        var dropdownButton = document.querySelector(selector + ' > [aria-expanded=true]');
        var dropdownBody = document.querySelector(selector + ' > [aria-hidden=false]');
        // If the body of the dropdown is visible, then toggle.
        if (dropdownBody) {
          dropdownButton.setAttribute('aria-expanded', false);
          dropdownBody.setAttribute('aria-hidden', true);
        }
      }
    });
  });
};

var toggleExpandable = function toggleExpandable(toggleElement) {
  var _ref = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {},
      _ref$context = _ref.context,
      context = _ref$context === undefined ? document : _ref$context,
      _ref$forceClose = _ref.forceClose,
      forceClose = _ref$forceClose === undefined ? false : _ref$forceClose,
      _ref$closeSiblings = _ref.closeSiblings,
      closeSiblings = _ref$closeSiblings === undefined ? false : _ref$closeSiblings,
      _ref$siblingsSelector = _ref.siblingsSelector,
      siblingsSelector = _ref$siblingsSelector === undefined ? '[aria-controls][aria-expanded]' : _ref$siblingsSelector;

  if (!toggleElement) {
    return;
  }

  // Get target element
  var target = document.getElementById(toggleElement.getAttribute('aria-controls'));

  // Exit if no target found
  if (!target) {
    return;
  }

  // Get current status
  var isExpanded = forceClose === true || toggleElement.getAttribute('aria-expanded') === 'true';

  // Toggle the expandable/collapsible
  toggleElement.setAttribute('aria-expanded', !isExpanded);
  target.setAttribute('aria-hidden', isExpanded);

  // Close siblings if requested
  if (closeSiblings === true) {
    var siblingsArray = Array.prototype.slice.call(context.querySelectorAll(siblingsSelector)).filter(function (sibling) {
      return sibling !== toggleElement;
    });

    siblingsArray.forEach(function (sibling) {
      toggleExpandable(sibling, {
        context: context,
        forceClose: true
      });
    });
  }
};

// Helper method to automatically attach the event listener to all the expandables on page load
var initExpandables = function initExpandables() {
  var selector = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '[aria-controls][aria-expanded]';
  var context = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : document;

  var nodesArray = Array.prototype.slice.call(context.querySelectorAll(selector));

  nodesArray.forEach(function (node) {
    return node.addEventListener('click', function () {
      return toggleExpandable(node, { context: context });
    });
  });
};

/*
 * Messages behavior
 */

// Dismiss a selected message.
function dismissMessage(message) {
  message.setAttribute('aria-hidden', true);
}

// Helper method to automatically attach the event listener to all the messages on page load
function initMessages() {
  var selectorClass = 'ecl-message__dismiss';

  var messages = Array.prototype.slice.call(document.getElementsByClassName(selectorClass));

  messages.forEach(function (message) {
    return message.addEventListener('click', function () {
      return dismissMessage(message.parentElement);
    });
  });
}

var megamenu = function megamenu(selector) {
  var megamenusArray = Array.prototype.slice.call(document.querySelectorAll(selector));

  megamenusArray.forEach(function (menu) {
    // Get expandables within the menu
    var nodesArray = Array.prototype.slice.call(menu.querySelectorAll('[aria-controls][aria-expanded]'));

    nodesArray.forEach(function (node) {
      return node.addEventListener('click', function () {
        toggleExpandable(node, {
          context: menu,
          closeSiblings: true
        });
      });
    });
  });
};

/**
 * Tables related behaviors.
 */

/* eslint-disable no-unexpected-multiline */

function eclTables() {
  var tables = document.getElementsByClassName('ecl-table');
  [].forEach.call(tables, function (table) {
    var headerText = [];
    var textColspan = '';
    var ci = 0;
    var cn = [];

    // The rows in a table body.
    var tableRows = table.querySelectorAll('tbody tr');

    // The headers in a table.
    var headers = table.querySelectorAll('thead tr th');

    // The number of main headers.
    var headFirst = table.querySelectorAll('thead tr')[0].querySelectorAll('th').length - 1;

    // Number of cells per row.
    var cellPerRow = table.querySelectorAll('tbody tr')[0].querySelectorAll('td').length;

    // Position of the eventual colspan element.
    var colspanIndex = -1;

    // Build the array with all the "labels"
    // Also get position of the eventual colspan element
    for (var i = 0; i < headers.length; i += 1) {
      if (headers[i].getAttribute('colspan')) {
        colspanIndex = i;
      }

      headerText[i] = [];
      headerText[i] = headers[i].textContent;
    }

    // If we have a colspan, we have to prepare the data for it.
    if (colspanIndex !== -1) {
      textColspan = headerText.splice(colspanIndex, 1);
      ci = colspanIndex;
      cn = table.querySelectorAll('th[colspan]')[0].getAttribute('colspan');

      for (var c = 0; c < cn; c += 1) {
        headerText.splice(ci + c, 0, headerText[headFirst + c]);
        headerText.splice(headFirst + 1 + c, 1);
      }
    }

    // For every row, set the attributes we use to make this happen.
    [].forEach.call(tableRows, function (row) {
      for (var j = 0; j < cellPerRow; j += 1) {
        if (headerText[j] === '' || headerText[j] === '\xA0') {
          row.querySelectorAll('td')[j].setAttribute('class', 'ecl-table__heading');
        } else {
          row.querySelectorAll('td')[j].setAttribute('data-th', headerText[j]);
        }

        if (colspanIndex !== -1) {
          var cell = row.querySelectorAll('td')[colspanIndex];
          cell.setAttribute('class', 'ecl-table__group-label');
          cell.setAttribute('data-th-group', textColspan);

          for (var _c = 1; _c < cn; _c += 1) {
            row.querySelectorAll('td')[colspanIndex + _c].setAttribute('class', 'ecl-table__group_element');
          }
        }
      }
    });
  });
}

// Heavily inspired by the tab component from https://github.com/frend/frend.co

/**
 * @param {object} options Object containing configuration overrides
 */
var tabs = function tabs() {
  var _ref = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {},
      _ref$selector = _ref.selector,
      selector = _ref$selector === undefined ? '.ecl-tabs' : _ref$selector,
      _ref$tablistSelector = _ref.tablistSelector,
      tablistSelector = _ref$tablistSelector === undefined ? '.ecl-tabs__tablist' : _ref$tablistSelector,
      _ref$tabpanelSelector = _ref.tabpanelSelector,
      tabpanelSelector = _ref$tabpanelSelector === undefined ? '.ecl-tabs__tabpanel' : _ref$tabpanelSelector,
      _ref$tabelementsSelec = _ref.tabelementsSelector,
      tabelementsSelector = _ref$tabelementsSelec === undefined ? tablistSelector + ' li' : _ref$tabelementsSelec;

  // SUPPORTS
  if (!('querySelector' in document) || !('addEventListener' in window) || !document.documentElement.classList) return null;

  // SETUP
  // set tab element NodeList
  var tabContainers = queryAll(selector);

  // ACTIONS
  function showTab(target) {
    var giveFocus = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;

    var siblingTabs = queryAll(tablistSelector + ' li', target.parentElement.parentElement);
    var siblingTabpanels = queryAll(tabpanelSelector, target.parentElement.parentElement);

    // set inactives
    siblingTabs.forEach(function (tab) {
      tab.setAttribute('tabindex', -1);
      tab.removeAttribute('aria-selected');
    });

    siblingTabpanels.forEach(function (tabpanel) {
      tabpanel.setAttribute('aria-hidden', 'true');
    });

    // set actives and focus
    target.setAttribute('tabindex', 0);
    target.setAttribute('aria-selected', 'true');
    if (giveFocus) target.focus();
    document.getElementById(target.getAttribute('aria-controls')).removeAttribute('aria-hidden');
  }

  // EVENTS
  function eventTabClick(e) {
    showTab(e.currentTarget);
    e.preventDefault(); // look into remove id/settimeout/reinstate id as an alternative to preventDefault
  }

  function eventTabKeydown(e) {
    // collect tab targets, and their parents' prev/next (or first/last)
    var currentTab = e.currentTarget;
    var previousTabItem = currentTab.previousElementSibling || currentTab.parentElement.lastElementChild;
    var nextTabItem = currentTab.nextElementSibling || currentTab.parentElement.firstElementChild;

    // don't catch key events when ⌘ or Alt modifier is present
    if (e.metaKey || e.altKey) return;

    // catch left/right and up/down arrow key events
    // if new next/prev tab available, show it by passing tab anchor to showTab method
    switch (e.keyCode) {
      case 37:
      case 38:
        showTab(previousTabItem);
        e.preventDefault();
        break;
      case 39:
      case 40:
        showTab(nextTabItem);
        e.preventDefault();
        break;
      default:
        break;
    }
  }

  // BINDINGS
  function bindTabsEvents(tabContainer) {
    var tabsElements = queryAll(tabelementsSelector, tabContainer);
    // bind all tab click and keydown events
    tabsElements.forEach(function (tab) {
      tab.addEventListener('click', eventTabClick);
      tab.addEventListener('keydown', eventTabKeydown);
    });
  }

  function unbindTabsEvents(tabContainer) {
    var tabsElements = queryAll(tabelementsSelector, tabContainer);
    // unbind all tab click and keydown events
    tabsElements.forEach(function (tab) {
      tab.removeEventListener('click', eventTabClick);
      tab.removeEventListener('keydown', eventTabKeydown);
    });
  }

  // DESTROY
  function destroy() {
    tabContainers.forEach(unbindTabsEvents);
  }

  // INIT
  function init() {
    tabContainers.forEach(bindTabsEvents);
  }

  // Automatically init
  init();

  // REVEAL API
  return {
    init: init,
    destroy: destroy
  };
};

// module exports

// Taking modules from ECL.

exports.accordions = accordions;
exports.dropdown = dropdown;
exports.toggleExpandable = toggleExpandable;
exports.initExpandables = initExpandables;
exports.initMessages = initMessages;
exports.megamenu = megamenu;
exports.eclTables = eclTables;
exports.tabs = tabs;

return exports;

}({}));
