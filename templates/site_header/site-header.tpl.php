<?php

/**
 * @file
 * Contains component file.
 */
?>
<header class="site-header site-header--homepage" role="banner">
  <div class="container-fluid site-header__container">
    <?php print render($logo); ?>
    <?php print $site_slogan; ?>
    <section class="top-bar" aria-label="Site tools">
      <div>
        <div class="top-bar__wrapper">
          <?php print render($lang_select_site); ?>
          <h1 class="sr-only">Site name</h1>
        </div>
      </div>
    </section>
  </div>
  <?php print render($search_bar); ?>
  <?php print render($page_header); ?>
 </header>
