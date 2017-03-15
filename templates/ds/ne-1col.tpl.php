<?php

/**
 * @file
 * Display Suite NE Bootstrap One Column.
 */
?>
<<?php print $layout_wrapper . $layout_attributes; ?> class="<?php print $classes; ?>">

<?php if (isset($title_suffix['contextual_links'])): ?>
  <?php print render($title_suffix['contextual_links']); ?>
<?php endif; ?>

<?php if (empty($hidelink)) : ?>
  <a href="<?php print $node_url; ?>" class="listing__item-link" title="<?php print $title; ?>"><span class="sr-only"><?php print $title; ?></span></a>
<?php endif; ?>

  <<?php print $main_wrapper; ?> class="listing__column-main <?php print $main_classes; ?>">
    <?php print $main; ?>
  </<?php print $main_wrapper; ?>>

</<?php print $layout_wrapper; ?>>

<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children; ?>
<?php endif; ?>
