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
  if (empty($variables[$hook])) {
    return;
  }
  $variables[$hook][$hook]['#attributes']['class'] = 'ecl-pager';

  foreach ($variables[$hook][$hook]['#items'] as $key => &$item) {
    $item['#attributes']['class'][] = 'ecl-pager__item';

    if ('pager_previous' == $key) {
      $item['#attributes']['class'][] = 'ecl-pager__item--previous';
    }
    if ('pager_first' == $key) {
      $item['#attributes']['class'][] = 'ecl-pager__item--first';
      $item['link']['#text'] = 1;
    }
    if (strpos($key, 'pager_ellipsis') !== FALSE) {
      $item['#attributes']['class'][] = 'ecl-pager__item--ellipsis';
    }
    if ('pager_last' == $key) {
      $item['#attributes']['class'][] = 'ecl-pager__item--last';
      $item['link']['#text'] = $variables['pager_total'][0];
    }
    if ('pager_next' == $key) {
      $item['#attributes']['class'][] = 'ecl-pager__item--next';
    }
    if ('pager_current' == $key) {
      $item['#attributes']['class'][] = 'ecl-pager__item--current';
      $item['#markup'] = array(
        'prefix' => array(
          '#theme' => 'html_tag',
          '#tag' => 'span',
          '#attributes' => array(
            'class' => array(
              'ecl-pager__item-text',
            ),
          ),
          '#value' => t('Page'),
        ),
        'separator' => array(
          '#markup' => ' ',
        ),
        'value' => array(
          '#markup' => $item['#markup'],
        ),
      );
    }
  }

  // Avoid duplicated link for the first item.
  $items = $variables[$hook][$hook]['#items'];
  if (isset($items['pager_first'])) {
    // In Europa, the order of "first" and "last" elements are swapped.
    $items = array_swap_assoc('pager_previous', 'pager_first', $items);
    $first = $items['pager_first'];
    foreach ($items as $key => $item) {
      if (strpos($key, 'pager_link') !== FALSE) {
        if ($first['link']['#text'] == $item['link']['#text']) {
          unset($items[$key]);
        }
      }
    }
  }
  $variables[$hook][$hook]['#items'] = $items;

  // Avoid duplicated link for the last item.
  $items = $variables[$hook][$hook]['#items'];
  if (isset($items['pager_last'])) {
    // In Europa, the order of "first" and "last" elements are swapped.
    $items = array_swap_assoc('pager_next', 'pager_last', $items);
    $last = $items['pager_last'];
    foreach ($items as $key => $item) {
      if (strpos($key, 'pager_link') !== FALSE) {
        if ($last['link']['#text'] == $item['link']['#text']) {
          unset($items[$key]);
        }
      }
    }
  }
  $variables[$hook][$hook]['#items'] = $items;

  // Remove empty links.
  $items = $variables[$hook][$hook]['#items'];
  foreach ($items as $key => $item) {
    if ('pager_current' == $key) {
      continue;
    }
    if (strpos($key, 'pager_ellipsis') !== FALSE) {
      continue;
    }
    if (empty($item['link']['#text'])) {
      unset($items[$key]);
    }
  }
  $variables[$hook][$hook]['#items'] = $items;

  // Adds specific class to pager links.
  foreach ($variables[$hook][$hook]['#items'] as &$item) {
    $item['link']['#options']['attributes']['class'][] = 'ecl-pager__link';
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
