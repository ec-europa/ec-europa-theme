<?php

/**
 * @file
 * Contains template file.
 */
?>
<?php if ($title): ?>
  <div class="ecl-message__title"><?php print render($title); ?></div>
<?php endif; ?>

<?php if (!empty($variables['items'])): ?>
  <?php if ($type): ?>
    <<?php print $type; ?><?php print $attributes; ?>>
  <?php endif; ?>
  <?php foreach ($variables['items'] as $item): ?>
    <?php print render($item); ?>
  <?php endforeach; ?>
  <?php if ($type): ?>
    </<?php print $type; ?>>
  <?php endif; ?>
<?php endif; ?>
