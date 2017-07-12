<?php

/**
 * @file
 * Contains template file for the "header" search form.
 */
?>

<label class="ecl-search-form__textfield-wrapper">
  <?php if (isset($displayed_label)): ?>
    <span class="ecl-sr-only"><?php print $displayed_label; ?></span>
  <?php endif; ?>
  <?php print $element['#children']; ?>
</label>
