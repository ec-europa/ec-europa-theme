<?php

/**
 * @file
 * Contains pager component file.
 */

/**
 * Implements hook_atomium_definition_HOOK().
 */
function europa_atomium_definition_pager() {
  return array(
    'label' => 'Pager',
    'description' => 'Nexteuropa Pager',
    'preview' => array(
      'pager_page_array' => array(
        0 => rand(0, 30),
      ),
      'pager_total' => array(
        0 => 30,
      ),
    ),
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_pager(&$variables, $hook) {
  global $pager_page_array, $pager_total;

  if (empty($variables[$hook])) {
    return;
  }

  // Max is the maximum page number.
  $element = $variables['element'];
  $quantity = $variables['quantity'];
  $pager_max = $pager_total[$element];
  $pager_middle = ceil($quantity / 2);
  $pager_current = $pager_page_array[$element] + 1;
  $pager_first = $pager_current - $pager_middle + 1;

  $pager_last = $pager_current + $quantity - $pager_middle;
  if ($pager_current < $pager_middle) {
    $pager_last = $quantity;
  }

  // Make sure that last page is not higher of total number of pages.
  if ($pager_last > $pager_max) {
    $pager_last = $pager_max;
  }

  // If pages are less than $quantity then display them all.
  if ($pager_max <= $quantity) {
    $pager_first = 1;
    $pager_last = $pager_max;
  }

  // Pass along pager figures for later processing.
  $variables['pager_first'] = $pager_first < 1 ? 1 : $pager_first;
  $variables['pager_middle'] = $pager_middle;
  $variables['pager_last'] = $pager_last;
  $variables['pager_current'] = $pager_page_array[$element] + 1;
  $variables['pager_max'] = $pager_max;

  foreach ($variables['pager']['pager']['#items'] as $key => $item) {
    if (isset($item['link'])) {
      $variables['links'][$key] = array(
        'url' => url($item['link']['#path'], $item['link']['#options']),
        'label' => $item['link']['#text'],
      );
    }
  }
}

/**
 * Helper function to swap two elements in an array.
 *
 * @param mixed $key1
 *   The key of the first element.
 * @param mixed $key2
 *   The key of the second element.
 * @param array $array
 *   The array containing the elements.
 *
 * @return array
 *   A new array with the elements swapped.
 */
function array_swap_assoc($key1, $key2, array $array) {
  $newArray = array();
  foreach ($array as $key => $value) {
    if ($key == $key1) {
      $newArray[$key2] = $array[$key2];
    }
    elseif ($key == $key2) {
      $newArray[$key1] = $array[$key1];
    }
    else {
      $newArray[$key] = $value;
    }
  }
  return $newArray;
}
