<?php

/**
 * @file
 * Contains template file.
 */
?>

<div<?php print render($attributes); ?>>
  <span class="ecl-meta__item ecl-u-f-up"><?php print render($type); ?></span>
  <span class="ecl-meta__item">
    <span class="date-display-single" property="dc:date" datatype="xsd:dateTime" content="<?php print render($timestamp); ?>"><?php print render($date); ?></span>
  </span>
  <span class="ecl-meta__item"><?php print render($location); ?></span>
</div>

