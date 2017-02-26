<?php

/**
 * @file
 * Display Suite NE Bootstrap Two Columns Sidebar Without Link.
 */

  // Add sidebar classes so that we can apply the correct width in css.
  // Second block is needed to activate display suite support on forms.
?>

<<?php print $layout_wrapper . $layout_attributes; ?> class="<?php print $classes; ?>">
  <?php if (isset($title_suffix['contextual_links'])) : ?>
    <?php print render($title_suffix['contextual_links']); ?>
  <?php endif; ?>
  <?php if (!empty($second)): ?>
    <<?php print $main_wrapper; ?> class="listing__column-main listing__column-main--sidebar-next column-main <?php print $main_classes; ?>">
      <?php if (!isset($prevent_link)) : ?>
        <a href="<?php print $node_url; ?>" class="listing__item-link"></a>
      <?php else: ?>
        <div class="listing__item-nolink">
      <?php endif; ?>
        <?php print $main; ?>
      <?php if (!isset($prevent_link)) : ?>
        </a>
      <?php else: ?>
        </div>
      <?php endif; ?>
    </<?php print $main_wrapper; ?>>
    <<?php print $second_wrapper; ?> class="listing__column-second listing__column-second--no-link column-second <?php print $second_classes; ?>">
      <?php print $second; ?>
    </<?php print $second_wrapper; ?>>
  <?php else: ?>
    <?php if (!isset($prevent_link)) : ?>
      <a href="<?php print $node_url; ?>" class="listing__item-link">
    <?php else: ?>
      <div class="listing__item-link">
    <?php endif; ?>
      <<?php print $main_wrapper; ?> class="listing__column-main column-main <?php print $main_classes; ?>">
        <?php print $main; ?>
      </<?php print $main_wrapper; ?>>
    <?php if (isset($prevent_link)) : ?>
      </div>
    <?php endif; ?>
  <?php endif; ?>
</<?php print $layout_wrapper; ?>>

<?php if (!empty($drupal_render_children)) : ?>
  <?php print $drupal_render_children; ?>
<?php endif; ?>
