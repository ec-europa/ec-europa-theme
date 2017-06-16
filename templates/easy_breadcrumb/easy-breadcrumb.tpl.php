<?php

/**
 * @file
 * Contains template file.
 */
?>
<div style="background-color: #004494; padding: 5px 15px 15px; float: left; width: 100%;">
  <nav class="ecl-breadcrumbs" aria-label="breadcrumbs">
    <span class="ecl-sr-only"><?php echo $here; ?></span>
    <ol class="ecl-breadcrumbs__segments-wrapper">
      <?php print render($easy_breadcrumb); ?>
    </ol>
  </nav>
</div>
