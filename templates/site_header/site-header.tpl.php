<?php

/**
 * @file
 * Contains component file.
 */
?>
  <div class="container-fluid site-header__container">
    <?php print render($logo); ?>
    <?php print $site_slogan; ?>
    <section class="top-bar" aria-label="Site tools">
      <div>
        <div class="top-bar__wrapper">
          <?php print render($lang_select_site); ?>
          <h1 class="sr-only"><?php print $site_name; ?></h1>
        </div>
      </div>
    </section>
  </div>
  <?php print render($search_bar); ?>
