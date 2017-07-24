<?php

/**
 * @file
 * Ds_layouts for europa theme implementation.
 */

/**
 * Implement NE 1 col section item layout.
 */
function ds_ne_1col_section_item() {
  return array(
    'label' => t('NE: 1col section item'),
    'regions' => array(
      'title' => t('Title'),
      'description' => t('Description'),
      'children' => t('Children'),
      'links' => t('Links'),
    ),
    // Add this line if there is a default css file.
    'css' => TRUE,
    // Add this line if you're using DS 2.x for icon preview.
    'image' => TRUE,
    'form' => TRUE,
  );
}
