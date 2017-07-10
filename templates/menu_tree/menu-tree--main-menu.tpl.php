<?php

/**
 * @file
 * Contains template file.
 */
?>
<?php if ($depth == 1): ?>
  <nav class="ecl-navigation-menu" aria-label="Main Navigation">
    <div class="ecl-container">
      <div class="ecl-row">
        <button class="ecl-navigation-menu__toggle ecl-navigation-menu__hamburger ecl-navigation-menu__hamburger--squeeze" aria-controls="nav-menu-expandable-root" aria-expanded="false" id="nav-menu-expandable-toggle">
          <span class="ecl-navigation-menu__hamburger-box">
            <span class="ecl-navigation-menu__hamburger-inner"></span>
          </span>
          <span class="ecl-navigation-menu__hamburger-label"><?php print $title; ?></span>
        </button>
<?php endif; ?>
        <ul<?php print $attributes; ?>><?php print render($tree); ?></ul>
<?php if ($depth == 1): ?>
      </div>
    </div>
  </nav>
<?php endif; ?>
