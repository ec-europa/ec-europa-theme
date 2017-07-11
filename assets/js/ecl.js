var ECL = (function (exports) {
'use strict';

// Query helper
const queryAll = (selector, context = document) =>
  [].slice.call(context.querySelectorAll(selector));

// Heavily inspired by the accordion component from https://github.com/frend/frend.co

/**
 * @param {object} options Object containing configuration overrides
 */
const accordions = (
  {
    selector: selector = '.ecl-accordion',
    headerSelector: headerSelector = '.ecl-accordion__header',
  } = {}
) => {
  // SUPPORTS
  if (
    !('querySelector' in document) ||
    !('addEventListener' in window) ||
    !document.documentElement.classList
  )
    return null;

  // SETUP
  // set accordion element NodeLists
  const accordionContainers = queryAll(selector);

  // ACTIONS
  function hidePanel(target) {
    // get panel
    const activePanel = document.getElementById(
      target.getAttribute('aria-controls')
    );

    target.setAttribute('aria-expanded', 'false');

    // toggle aria-hidden
    activePanel.setAttribute('aria-hidden', 'true');
  }

  function showPanel(target) {
    // get panel
    const activePanel = document.getElementById(
      target.getAttribute('aria-controls')
    );

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
    const currentHeader = e.currentTarget;
    const isModifierKey = e.metaKey || e.altKey;
    // get context of accordion container and its children
    const thisContainer = currentHeader.parentNode.parentNode;
    const theseHeaders = queryAll(headerSelector, thisContainer);
    const currentHeaderIndex = [].indexOf.call(theseHeaders, currentHeader);

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
      case 38: {
        const previousHeaderIndex =
          currentHeaderIndex === 0
            ? theseHeaders.length - 1
            : currentHeaderIndex - 1;
        giveHeaderFocus(theseHeaders, previousHeaderIndex);
        e.preventDefault();
        break;
      }
      case 39:
      case 40: {
        const nextHeaderIndex =
          currentHeaderIndex < theseHeaders.length - 1
            ? currentHeaderIndex + 1
            : 0;
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
    const accordionHeaders = queryAll(headerSelector, accordionContainer);
    // bind all accordion header click and keydown events
    accordionHeaders.forEach(accordionHeader => {
      accordionHeader.addEventListener('click', eventHeaderClick);
      accordionHeader.addEventListener('keydown', eventHeaderKeydown);
    });
  }

  // UNBIND EVENTS
  function unbindAccordionEvents(accordionContainer) {
    const accordionHeaders = queryAll(headerSelector, accordionContainer);
    // unbind all accordion header click and keydown events
    accordionHeaders.forEach(accordionHeader => {
      accordionHeader.removeEventListener('click', eventHeaderClick);
      accordionHeader.removeEventListener('keydown', eventHeaderKeydown);
    });
  }

  // DESTROY
  function destroy() {
    accordionContainers.forEach(accordionContainer => {
      unbindAccordionEvents(accordionContainer);
    });
  }

  // INIT
  function init() {
    if (accordionContainers.length) {
      accordionContainers.forEach(accordionContainer => {
        bindAccordionEvents(accordionContainer);
      });
    }
  }

  init();

  // REVEAL API
  return {
    init,
    destroy,
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

const toggleExpandable = (
  toggleElement,
  {
    context = document,
    forceClose = false,
    closeSiblings = false,
    siblingsSelector = '[aria-controls][aria-expanded]',
  } = {}
) => {
  if (!toggleElement) {
    return;
  }

  // Get target element
  const target = document.getElementById(
    toggleElement.getAttribute('aria-controls')
  );

  // Exit if no target found
  if (!target) {
    return;
  }

  // Get current status
  const isExpanded =
    forceClose === true ||
    toggleElement.getAttribute('aria-expanded') === 'true';

  // Toggle the expandable/collapsible
  toggleElement.setAttribute('aria-expanded', !isExpanded);
  target.setAttribute('aria-hidden', isExpanded);

  // Close siblings if requested
  if (closeSiblings === true) {
    const siblingsArray = Array.prototype.slice
      .call(context.querySelectorAll(siblingsSelector))
      .filter(sibling => sibling !== toggleElement);

    siblingsArray.forEach(sibling => {
      toggleExpandable(sibling, {
        context,
        forceClose: true,
      });
    });
  }
};

// Helper method to automatically attach the event listener to all the expandables on page load
const initExpandables = (
  selector = '[aria-controls][aria-expanded]',
  context = document
) => {
  const nodesArray = Array.prototype.slice.call(
    context.querySelectorAll(selector)
  );

  nodesArray.forEach(node =>
    node.addEventListener('click', () => toggleExpandable(node, { context }))
  );
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
  const selectorClass = 'ecl-message__dismiss';

  const messages = Array.prototype.slice.call(
    document.getElementsByClassName(selectorClass)
  );

  messages.forEach(message =>
    message.addEventListener('click', () =>
      dismissMessage(message.parentElement)
    )
  );
}

const megamenu = selector => {
  const megamenusArray = Array.prototype.slice.call(
    document.querySelectorAll(selector)
  );

  megamenusArray.forEach(menu => {
    // Get expandables within the menu
    const nodesArray = Array.prototype.slice.call(
      menu.querySelectorAll('[aria-controls][aria-expanded]')
    );

    nodesArray.forEach(node =>
      node.addEventListener('click', () => {
        toggleExpandable(node, {
          context: menu,
          closeSiblings: true,
        });
      })
    );
  });
};

/**
 * Tables related behaviors.
 */

/* eslint-disable no-unexpected-multiline */

function eclTables() {
  const tables = document.getElementsByClassName('ecl-table');
  [].forEach.call(tables, table => {
    const headerText = [];
    let textColspan = '';
    let ci = 0;
    let cn = [];

    // The rows in a table body.
    const tableRows = table.querySelectorAll('tbody tr');

    // The headers in a table.
    const headers = table.querySelectorAll('thead tr th');

    // The number of main headers.
    const headFirst =
      table.querySelectorAll('thead tr')[0].querySelectorAll('th').length - 1;

    // Number of cells per row.
    const cellPerRow = table
      .querySelectorAll('tbody tr')[0]
      .querySelectorAll('td').length;

    // Position of the eventual colspan element.
    let colspanIndex = -1;

    // Build the array with all the "labels"
    // Also get position of the eventual colspan element
    for (let i = 0; i < headers.length; i += 1) {
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

      for (let c = 0; c < cn; c += 1) {
        headerText.splice(ci + c, 0, headerText[headFirst + c]);
        headerText.splice(headFirst + 1 + c, 1);
      }
    }

    // For every row, set the attributes we use to make this happen.
    [].forEach.call(tableRows, row => {
      for (let j = 0; j < cellPerRow; j += 1) {
        if (headerText[j] === '' || headerText[j] === '\u00a0') {
          row
            .querySelectorAll('td')
            [j].setAttribute('class', 'ecl-table__heading');
        } else {
          row.querySelectorAll('td')[j].setAttribute('data-th', headerText[j]);
        }

        if (colspanIndex !== -1) {
          const cell = row.querySelectorAll('td')[colspanIndex];
          cell.setAttribute('class', 'ecl-table__group-label');
          cell.setAttribute('data-th-group', textColspan);

          for (let c = 1; c < cn; c += 1) {
            row
              .querySelectorAll('td')
              [colspanIndex + c].setAttribute(
                'class',
                'ecl-table__group_element'
              );
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
const tabs = (
  {
    selector: selector = '.ecl-tabs',
    tablistSelector: tablistSelector = '.ecl-tabs__tablist',
    tabpanelSelector: tabpanelSelector = '.ecl-tabs__tabpanel',
    tabelementsSelector: tabelementsSelector = `${tablistSelector} li`,
  } = {}
) => {
  // SUPPORTS
  if (
    !('querySelector' in document) ||
    !('addEventListener' in window) ||
    !document.documentElement.classList
  )
    return null;

  // SETUP
  // set tab element NodeList
  const tabContainers = queryAll(selector);

  // ACTIONS
  function showTab(target, giveFocus = true) {
    const siblingTabs = queryAll(
      `${tablistSelector} li`,
      target.parentElement.parentElement
    );
    const siblingTabpanels = queryAll(
      tabpanelSelector,
      target.parentElement.parentElement
    );

    // set inactives
    siblingTabs.forEach(tab => {
      tab.setAttribute('tabindex', -1);
      tab.removeAttribute('aria-selected');
    });

    siblingTabpanels.forEach(tabpanel => {
      tabpanel.setAttribute('aria-hidden', 'true');
    });

    // set actives and focus
    target.setAttribute('tabindex', 0);
    target.setAttribute('aria-selected', 'true');
    if (giveFocus) target.focus();
    document
      .getElementById(target.getAttribute('aria-controls'))
      .removeAttribute('aria-hidden');
  }

  // EVENTS
  function eventTabClick(e) {
    showTab(e.currentTarget);
    e.preventDefault(); // look into remove id/settimeout/reinstate id as an alternative to preventDefault
  }

  function eventTabKeydown(e) {
    // collect tab targets, and their parents' prev/next (or first/last)
    const currentTab = e.currentTarget;
    const previousTabItem =
      currentTab.previousElementSibling ||
      currentTab.parentElement.lastElementChild;
    const nextTabItem =
      currentTab.nextElementSibling ||
      currentTab.parentElement.firstElementChild;

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
    const tabsElements = queryAll(tabelementsSelector, tabContainer);
    // bind all tab click and keydown events
    tabsElements.forEach(tab => {
      tab.addEventListener('click', eventTabClick);
      tab.addEventListener('keydown', eventTabKeydown);
    });
  }

  function unbindTabsEvents(tabContainer) {
    const tabsElements = queryAll(tabelementsSelector, tabContainer);
    // unbind all tab click and keydown events
    tabsElements.forEach(tab => {
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
    init,
    destroy,
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
