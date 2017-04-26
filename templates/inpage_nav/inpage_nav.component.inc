<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_theme_HOOK().
 */
function europa_atomium_theme_inpage_nav() {
  return array(
    'inpage_nav' => array(
      'variables' => array(
        'counter' => NULL,
        'title' => NULL,
        'content' => NULL,
      ),
      'template' => 'banner',
    ),
  );
}

/**
 * Implements hook_atomium_definition_HOOK().
 */
function europa_atomium_definition_inpage_nav() {
  return array(
    'label' => 'In page navigation',
    'description' => 'Inpage navigation.',
    'preview' => array(
      'counter' => '3',
      'title' => 'President Juncker',
      'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sed nunc id metus vulputate dignissim. Donec eleifend, nulla ut vehicula dapibus, nisl leo malesuada justo, in imperdiet elit felis eget nisi. ',
    ),
  );
}
