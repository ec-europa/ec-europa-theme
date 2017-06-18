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

<div <?php print drupal_attributes($attributes_array); ?>>
    <?php foreach ($rows as $row_number => $columns): ?>
        <div class="ecl-row <?php
        if (isset($row_classes[$row_number])) {
          print $row_classes[$row_number];
        }?> ">
          <?php foreach ($columns as $column_number => $item): ?>
              <div class="ecl-col <?php
                 if (isset($column_classes[$row_number][$column_number])) {
                   print $column_classes[$row_number][$column_number];
                 } ?> ">
                <?php print $item; ?>
              </div>
          <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
 </div>
