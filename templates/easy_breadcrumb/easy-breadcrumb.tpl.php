<?php

/**
 * @file
 * Contains template file.
 */
?>
<nav class="ecl-breadcrumbs <?php print render($extra_class); ?>" aria-label="breadcrumbs">
  <span class="ecl-sr-only"><?php print render($here); ?></span>
  <ol class="ecl-breadcrumbs__segments-wrapper">
    <?php print render($easy_breadcrumb); ?>
  </ol>
</nav>
