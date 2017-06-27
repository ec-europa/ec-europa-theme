<?php

/**
 * @file
 * Contains component file.
 */
?>
<header class="ecl-site-header ecl-site-header--homepage" role="banner">
 <div class="container-fluid ecl-site-header__container">
 <section class="ecl-site-header__top-bar" aria-label="Site tools">
   <div class="ecl-site-header__top-bar__wrapper">
     <?php print render($lang_select_site); ?>
   </div>
 </section>
    <?php print render($logo); ?>
    <?php print render($site_slogan); ?>
    <span class="ecl-sr-only"><?php print $site_name; ?></span>
    <?php print render($search_bar); ?>
  </div>
</header>
