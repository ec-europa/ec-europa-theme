<?php

/**
 * @file
 * Display Suite NE Bootstrap Two Columns Hit Me.
 */

  // Add sidebar classes so that we can apply the correct width in css.
  // Second block is needed to activate display suite support on forms.
?>

<<?php print $layout_wrapper . $layout_attributes; ?> class="<?php print $classes; ?>">
  <?php if (isset($title_suffix['contextual_links'])) : ?>
    <?php print render($title_suffix['contextual_links']); ?>
  <?php endif; ?>
  <?php if (!isset($prevent_link)) : ?>
    <a href="<?php print $node_url; ?>" class="listing__item-link"></a>
  <?php else: ?>
    <div class="listing__item-nolink">
  <?php endif; ?>
    <?php if (!empty($second)) : ?>
      <<?php print $second_wrapper; ?> class="listing__column-second column-second <?php print $second_classes; ?>">
        <?php print $second; ?>
      </<?php print $second_wrapper; ?>>
    <?php endif; ?>
    <<?php print $main_wrapper; ?> class="listing__column-main column-main <?php print $main_classes; ?>">
      <?php print $main; ?>
    </<?php print $main_wrapper; ?>>
    </div>
</<?php print $layout_wrapper; ?>>

<?php if (!empty($drupal_render_children)) : ?>
  <?php print $drupal_render_children; ?>
<?php endif; ?>
