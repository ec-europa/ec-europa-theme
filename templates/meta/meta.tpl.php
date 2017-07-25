<?php

/**
 * @file
 * Contains template file.
 */
?>

<div<?php print render($attributes); ?>>
  <?php if (!empty($type)): ?>
    <span class="ecl-meta__item ecl-u-f-up"><?php print render($type); ?></span>
  <?php endif; ?>
  <?php if (!empty($date)): ?>
    <span class="ecl-meta__item">
      <span class="date-display-single" property="dc:date" datatype="xsd:dateTime" content="<?php print render($timestamp); ?>"><?php print render($date); ?></span>
    </span>
  <?php endif; ?>
  <?php if (!empty($location)): ?>
    <span class="ecl-meta__item"><?php print render($location); ?></span>
  <?php endif; ?>
</div>
