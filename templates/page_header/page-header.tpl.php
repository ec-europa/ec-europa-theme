<?php

/**
 * @file
 * Contains template file.
 */
?>
<div class="ecl-page-header">
  <?php print render($breadcrumb); ?>
  <div class="ecl-page-header__body">
      <?php if (!empty($identity)): ?>
        <div class="ecl-page-header__identity">
          <?php print render($identity); ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($meta)): ?>
        <div class="ecl-page-header__meta">
          <?php print render($meta); ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($title)): ?>
        <div class="ecl-page-header__title">
          <?php print render($title_prefix); ?>
          <h1 class="ecl-heading ecl-heading--h1 ecl-u-color-white"><?php print render($title); ?></h1>
          <?php print render($title_suffix); ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($introduction)): ?>
        <div class="ecl-page-header__intro">
          <p class="ecl-paragraph ecl-paragraph--l">
            <?php print render($introduction); ?>
          </p>
        </div>
      <?php endif; ?>
  </div>
</div>
