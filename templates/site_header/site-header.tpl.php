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
    <section class="header-search-bar" aria-label="Site tools">
        <div class="header-search-bar__wrapper container-fluid">
            <section class="block-nexteuropa-europa-search clearfix">
                <form class="search-form">
                    <div class="input-group">
                        <label class="search-form__textfield-wrapper">
      <span class="ecl-sr-only">Search this website</span>
      <input type="search" class="search-form__textfield form-control" size="60" maxlength="128" title="Search">
    </label>
                        <span class="search-form__btn-wrapper input-group-btn">
      <button class="search-form__btn btn btn-primary btn-search" value="Search" type="submit">Search</button>
    </span>
                    </div>
                </form>
            </section>
        </div>
    </section>
</header>
