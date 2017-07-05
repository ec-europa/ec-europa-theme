<?php

/**
 * @file
 * Contains component file.
 */
/**
 * Implements hook_preprocess_views_view_grid().
 */
function europa_preprocess_views_view_grid(&$variables) {
  $view = $variables['view'];
  $result = $view->result;
  $options = $view->style_plugin->options;
  $handler = $view->style_plugin;
  $default_row_class = isset($options['default_row_class']) ? $options['default_row_class'] : TRUE;
  $row_class_special = isset($options['row_class_special']) ? $options['row_class_special'] : TRUE;

  $columns = $options['columns'];

  $rows = array();
  $row_indexes = array();

  if ($options['alignment'] == 'horizontal') {
    $row = array();
    $col_count = 0;
    $row_count = 0;
    $count = 0;
    foreach ($variables['rows'] as $row_index => $item) {
      $count++;
      $row[] = $item;
      $row_indexes[$row_count][$col_count] = $row_index;
      $col_count++;
      if ($count % $columns == 0) {
        $rows[] = $row;
        $row = array();
        $col_count = 0;
        $row_count++;
      }
    }
    if ($row) {
      // Fill up the last line only if it's configured, but this is default.
      if (!empty($handler->options['fill_single_line']) && count($rows)) {
        for ($i = 0; $i < ($columns - $col_count); $i++) {
          $row[] = '';
        }
      }
      $rows[] = $row;
    }
  }
  else {
    $num_rows = floor(count($vars['rows']) / $columns);
    // The remainders are the 'odd' columns that are slightly longer.
    $remainders = count($vars['rows']) % $columns;
    $row = 0;
    $col = 0;
    foreach ($vars['rows'] as $count => $item) {
      $rows[$row][$col] = $item;
      $row_indexes[$row][$col] = $count;
      $row++;

      if (!$remainders && $row == $num_rows) {
        $row = 0;
        $col++;
      }
      elseif ($remainders && $row == $num_rows + 1) {
        $row = 0;
        $col++;
        $remainders--;
      }
    }
    for ($i = 0; $i < count($rows[0]); $i++) {
      // This should be string so that's okay :)
      if (!isset($rows[count($rows) - 1][$i])) {
        $rows[count($rows) - 1][$i] = '';
      }
    }
  }

  // Apply the row classes.
  foreach ($rows as $row_number => $row) {
    $row_classes = array('');
    if ($default_row_class) {
      $row_classes[] = 'row-' . ($row_number + 1);
    }
    if ($row_class_special) {
      if ($row_number == 0) {
        $row_classes[] = 'row-first';
      }
      if (count($rows) == ($row_number + 1)) {
        $row_classes[] = 'row-last';
      }
    }
    $vars['row_classes'][$row_number] = implode(' ', $row_classes);
    foreach ($rows[$row_number] as $column_number => $item) {
      $column_classes = array('');
      if ($default_row_class) {
        $column_classes[] = 'col-' . ($column_number + 1);
      }
      if ($row_class_special) {
        if ($column_number == 0) {
          $column_classes[] = 'col-first';
        }
        elseif (count($rows[$row_number]) == ($column_number + 1)) {
          $column_classes[] = 'col-last';
        }
      }
      if (isset($row_indexes[$row_number][$column_number]) && $column_class = $view->style_plugin->get_row_class($row_indexes[$row_number][$column_number])) {
        $column_classes[] = $column_class;
      }
      $vars['column_classes'][$row_number][$column_number] = implode(' ', $column_classes);
    }
  }
  $vars['rows'] = $rows;
  $vars['class'] = 'views-view-grid cols-' . $columns;

  // Add the summary to the list if set.
  if (!empty($handler->options['summary'])) {
    $vars['attributes_array'] = array('summary' => filter_xss_admin($handler->options['summary']));
  }

  // Add the caption to the list if set.
  if (!empty($handler->options['caption'])) {
    $vars['caption'] = filter_xss_admin($handler->options['caption']);
  }
  else {
    $vars['caption'] = '';
  }
}

/**
 * Implements hook_preprocess_views_view_table().
 */
function europa_preprocess_views_view_table(&$variables) {
  $variables['classes_array'][] = 'table-responsive';
}
