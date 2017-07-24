<?php

/**
 * @file
 * Ds_layouts for europa theme implementation.
 */

/**
 * Implement NE 1 col stacked layout.
 */
function ds_ne_1col_stacked() {
  return array(
    'label' => t('NE: 1col stacked'),
    'regions' => array(
      'left_header' => t('Left Header'),
      'right_header' => t('Right Header'),
      'top' => t('Top'),
      'central' => t('Main'),
    ),
    // Add this line if there is a default css file.
    'css' => TRUE,
    // Add this line if you're using DS 2.x for icon preview.
    'image' => TRUE,
    'form' => TRUE,
  );
}
