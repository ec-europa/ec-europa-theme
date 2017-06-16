<?php

/**
 * @file
 * Contains template file.
 */
?>

<?php if (!empty($title)) : ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<?php if (!empty($caption)) : ?>
  <caption><?php print $caption; ?></caption>
<?php endif; ?>

<div class="ecl-container <?php print $class; ?>"<?php print $attributes; ?>>
  <?php foreach ($rows as $row_number => $columns): ?>
    <div class="ecl-row <?php print $row_classes[$row_number];?> ">
      <?php foreach ($columns as $column_number => $item): ?>
        <div class="ecl-col <?php print $column_classes[$row_number][$column_number];?> ">
          <?php print $item; ?>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endforeach; ?>
</div>
