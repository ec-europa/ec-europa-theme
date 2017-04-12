<?php

/**
 * @file
 * Contains component file.
 */
?>
<header class="site-header site-header--homepage" role="banner">
    <div class="container-fluid site-header__container">
        <section class="top-bar" aria-label="Site tools">
          <div class="top-bar__wrapper">
            <?php print render($lang_select_site); ?>                
          </div>
        </section>
        <?php print render($logo); ?>
    </div>
    <?php print render($search_bar); ?>
 </header>
