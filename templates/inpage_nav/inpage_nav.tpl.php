<?php

/**
 * @file
 * Contains template file.
 */
?>
<section id="heading-<?php echo $counter; ?>">
  <h2 class="block-title inpage-nav__block-title"><?php echo render($title); ?></h2>
  <?php echo render($content); ?>
</section>
