<?php

/**
 * @file
 * Contains component file.
 */
?>
<header class="ecl-site-header" role="banner">
  <div class="container-fluid ecl-site-header__container">
    <?php print render($logo); ?>
    <section class="ecl-site-header__top-bar" aria-label="Site tools">
      <div class="ecl-site-header__top-bar__wrapper">
        <?php print render($lang_select_site); ?>
        <?php print render($search_bar); ?>
      </div>
    </section>
  </div>
</header>
