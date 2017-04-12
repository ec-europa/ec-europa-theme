<?php

/**
 * @file
 * Contains component file.
 */
?>
<div class="lang-select-site clearfix">
  <a href="<?php print $url; ?>" class="lang-select-site__link">
    <span class="lang-select-site__label"><?php print render($label); ?></span>
    <span class="lang-select-site__code">
      <span class="icon icon--language lang-select-site__icon"></span>
      <span class="lang-select-site__code-text"><?php print render($code); ?></span>
    </span>
  </a>
</div>
