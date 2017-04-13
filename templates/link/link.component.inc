<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_definition_HOOK().
 */
function europa_atomium_definition_link() {
  return array(
    'label' => 'Links',
    'description' => 'Links templates. These can be formatted in UI. Check nexteuropa_formatters feature for more details. <br> Links can be shown as buttons, or tags.',
    'preview' => array(
      array(
        'text' => 'Button default',
        'attributes' => array(
          'class' => array(
            'btn-default',
            'btn',
          ),
        ),
      ),
      array(
        'text' => 'Button primary',
        'options' => array(
          'class' => array(
            'btn-primary',
            'btn',
          ),
        ),
      ),
      array(
        'text' => 'Button secondary',
        'attributes' => array(
          'class' => array(
            'btn-secondary',
            'btn',
          ),
        ),
      ),
      array(
        'text' => 'Button call to action',
        'attributes' => array(
          'class' => array(
            'btn-ctn',
            'btn',
          ),
        ),
      ),
      array(
        'text' => 'Button call to action with border',
        'attributes' => array(
          'class' => array(
            'btn-ctn--border',
            'btn',
          ),
        ),
      ),
      array(
        'text' => 'Button menu',
        'attributes' => array(
          'class' => array(
            'btn-menu',
            'btn',
          ),
        ),
      ),
      array(
        'text' => 'Button searcb',
        'attributes' => array(
          'class' => array(
            'btn-search',
            'btn',
          ),
        ),
      ),
      array(
        'text' => 'Tag',
        'attributes' => array(
          'class' => array(
            'tags__item',
          ),
        ),
      ),
      array(
        'text' => 'Facet tag',
        'attributes' => array(
          'class' => array(
            'facet-tag__value',
          ),
        ),
      ),
    ),
  );
}
