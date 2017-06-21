<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 * - $field_introduction: field that should be available in most of the
 *   content types.
 *
 * Regions:
 * - $page['header']:         Displayed in the right part of the
 *                            header -> logo, search box, ...
 * - $page['header_bottom']:  Displayed below the header, take full width of
 *                            site -> main menu, global information,
 *                            breadcrumb...
 * - $page['highlighted']:    Displayed in a big visible box -> important
 *                            message, contextual information, ...
 * - $page['help']:           Displayed between page title and
 *                            content -> information about the page,
 *                            contextual help, ...
 * - $page['sidebar_first']:  Small sidebar displayed on left of the content,
 *                            if not empty -> navigation, pictures, ...
 * - $page['sidebar_second']: Large sidebar displayed on right of the content,
 *                            if not empty -> two column layout
 * - $page['content']:        The main content of the current page.
 * - $page['footer']:         Displayed at bottom of the page, on full
 *                            width -> latest update, copyright, ...
 *
 * @see bootstrap_preprocess_page()
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see bootstrap_process_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
?>

<?php if (!empty($page['header_top'])): ?>
<section class="header-top">
  <div class="container-fluid">
    <?php print render($page['header_top']); ?>
  </div>
</section>
<?php endif; ?>

<header class="site-header" role="banner">
<?php print render($site_header); ?>
<?php print render($page['header']); ?>

</header>

<?php if (!empty($primary_nav) || !empty($secondary_nav) || !empty($page['navigation'])): ?>
  <section id="navbar" role="banner" class="<?php print render($navbar_classes); ?>">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      <div class="navbar-collapse collapse">
        <nav role="navigation">
        <?php if (!empty($primary_nav)): ?>
          <?php print render($primary_nav); ?>
        <?php endif; ?>
        <?php if (!empty($secondary_nav)): ?>
          <?php print render($secondary_nav); ?>
        <?php endif; ?>
        <?php if (!empty($page['navigation'])): ?>
          <?php print render($page['navigation']); ?>
        <?php endif; ?>
        </nav>
      </div>
    </div>
  </section>
<?php endif; ?>

<section class="main-content">
  <!-- Page Header -->
  <div class="page-header <?php if (isset($header_back)) : print ' page-header--image';
 endif; ?>">
  <?php if (!empty($page['header_bottom'])): ?>
    <nav class="page-navigation" role="navigation">
      <div class="container-fluid">
        <?php print render($page['header_bottom']); ?>
      </div>
    </nav>
  <?php endif; ?>
    
  <?php if (theme_get_setting('ec_europa_improved_website', 'europa')): ?>
    <?php if (!$is_front || $is_front && theme_get_setting('ec_europa_improved_website_home', 'europa')): ?>
    <div class="container-fluid page-header__site-identification">
      <h3><?php print $site_name; ?></h3>
    </div>
    <?php endif; ?>
  <?php endif; ?>
    
    <div class="container-fluid page-header__hero-title">
      <div class="row padding-reset">
        <div class="col-lg-9">
          <?php print render($title_prefix); ?>
          <?php if (!empty($page['custom_title'])): ?>
            <?php print render($page['custom_title']); ?>
          <?php else: ?>
            <h1><?php print render($title); ?></h1>
          <?php endif; ?>
          <?php print render($title_suffix); ?>

          <?php if(!empty($ec_europa_introduction)): ?>
            <?php print render($ec_europa_introduction); ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <?php if (!empty($page['utility'])): ?>
    <div class="utility">
      <div class="container-fluid">
        <?php print render($page['utility']); ?>
      </div>
    </div>
  <?php endif; ?>

  <!-- Generic sections -->
  <div class="container-fluid">
    <?php if (!empty($tabs)): ?>
      <?php print render($tabs); ?>
    <?php endif; ?>

    <?php if (!empty($page['help'])): ?>
      <?php print render($page['help']); ?>
    <?php endif; ?>

    <?php if (!empty($action_links)): ?>
      <ul class="action-links"><?php print render($action_links); ?></ul>
    <?php endif; ?>
  </div>

  <div class="page-content">
    <div class="container-fluid">
      <?php if (!empty($page['content_top'])): ?>
        <a id="top-content" tabindex="-2"></a>
        <div class="row">
          <?php print render($page['content_top']); ?>
        </div>
      <?php endif; ?>
      <a id="main-content" tabindex="-1"></a>
      <div class="row">
        <?php if (!empty($page['sidebar_first'])): ?>
          <aside class="col-md-3" role="complementary">
            <?php print render($page['sidebar_first']); ?>
          </aside> <!-- /#sidebar-first -->
        <?php endif; ?>

        <section class="section <?php print $content_column_class; ?>">
          <?php if (!empty($page['highlighted'])): ?>
            <div class="highlighted jumbotron"><?php print render($page['highlighted']); ?></div>
          <?php endif; ?>

          <?php if (!empty($messages)): ?>
            <?php print render($messages); ?>
          <?php endif; ?>

          <?php print render($page['content']); ?>

          <?php print render($page['content_bottom']); ?>
        </section>

        <?php if (!empty($page['sidebar_second'])): ?>
          <aside class="col-md-3" role="complementary">
            <?php print render($page['sidebar_second']); ?>
          </aside>  <!-- /#sidebar-second -->
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?php print render($footer); ?>