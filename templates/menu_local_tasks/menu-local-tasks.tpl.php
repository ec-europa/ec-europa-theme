<?php

/**
 * @file
 * Contains template file.
 */
?>
<?php if ($primary): ?>
  <nav class="ecl-navigation-list-wrapper">
    <h2 class="ecl-sr-only"><?php print $primary['#title']; ?></h2>
    <ul class="ecl-navigation-list ecl-navigation-list--tabs">
      <?php print render($menu_tab_links); ?>
    </ul>
  </nav>
<?php endif; ?>
<?php if ($secondary): ?>
  <nav class="ecl-navigation-list-wrapper">
    <ul class="ecl-navigation-list ecl-navigation-list--default">
      <?php print render($secondary_menu_tab_links); ?>
    </ul>
  </nav>
<?php endif; ?>
