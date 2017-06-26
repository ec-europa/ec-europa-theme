<?php

/**
 * @file
 * Contains component file.
 */
?>
<div class="ecl-lang-select-sites">
  <a href="<?php print $url; ?>" class="ecl-lang-select-sites__link">
    <span class="ecl-lang-select-sites__label"><?php print render($label); ?></span>
    <span class="ecl-lang-select-sites__code">
      <span class="ecl-icon ecl-icon--language ecl-lang-select-sites__icon"></span>
      <span class="ecl-lang-select-sites__code-text"><?php print render($code); ?></span>
    </span>
  </a>
</div>
