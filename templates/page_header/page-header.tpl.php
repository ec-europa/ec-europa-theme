<?php

/**
 * @file
 * Contains template file.
 */
?>
<div class="ecl-page-header">
  <?php print render($header_bottom); ?>
  <div class="ecl-page-header__body">
      <?php print render($page_header); ?>
      <div class="ecl-page-header__identity">
        <?php print render($site_name); ?>
      </div>

      <?php if (!empty($page_meta)): ?>
        <div class="ecl-page-header__meta">
          <?php print render($page_meta); ?>
        </div>
      <?php endif; ?>

      <div class="ecl-page-header__title">
        <?php print render($title_prefix); ?>
        <h1 class=" ecl-heading ecl-heading--h1 ecl-u-color-white"><?php print render($page_title); ?></h1>
        <?php print render($title_suffix); ?>
      </div>

      <?php if (!empty($page_intro)): ?>
        <div class="ecl-page-header__intro">
          <?php print render($page_intro); ?>
        </div>
      <?php endif; ?>
  </div>
</div>
