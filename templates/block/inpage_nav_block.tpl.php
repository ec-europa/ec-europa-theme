<?php

/**
 * @file
 * Theme file for inpage nav.
 */
?>
<div class="section inpage-nav__wrapper">
  <?php if ($title): ?>
    <h3 class="block__title inpage-nav__block-title"><?php print render($title); ?></h3>
  <?php endif; ?>
  <div class="inpage-nav is-scrollspy-target">
    <?php if ($links): ?>
      <?php print render($links); ?>
    <?php endif; ?>
  </div>
</div>

