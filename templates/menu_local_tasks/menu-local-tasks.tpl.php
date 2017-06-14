<?php

/**
 * @file
 * Contains template file.
 */
?>
<?php if ($primary): ?>
  <nav class="ecl-navigation-wrapper">
    <h2 class="ecl-sr-only"><?php print t('Primary tabs') ?></h2>
    <ul class="ecl-navigation ecl-navigation--tabs">
      <?php foreach ($menu_tab_links as $menu_tab_link): ?>
        <?php print render($menu_tab_link); ?>
      <?php endforeach; ?>
    </ul>
  </nav>
<?php endif; ?>
<?php if ($secondary): ?>
  <?php print render($secondary); ?>
<?php endif; ?>
