<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_theme_HOOK().
 */
function europa_atomium_theme_footer() {
  return array(
    'footer' => array(
      'variables' => array(
        'footer_left' => NULL,
        'footer_right' => NULL,
        'footer_middle' => NULL,
        'footer_bottom' => NULL,
        'footer_improved' => NULL,
      ),
      'template' => 'footer',
    ),
  );
}

/**
 * Implements hook_atomium_definition_HOOK().
 */
function europa_atomium_definition_footer() {

  $footer_improved = '<div class="ecl-col-sm ecl-footer__column"><h4 class="ecl-h4"><a href="#">Digital single market</a></h4></div><div class="ecl-col-sm ecl-footer__column"><p class="ecl-footer__label">Follow us:</p><ul class="ecl-footer__menu ecl-list-inline"><li class="ecl-footer__menu-item ecl-list-inline__item"><a class="" href="#"><span class="ecl-icon ecl-icon--facebook ecl-footer__social-icon"></span>Facebook</a></li><li class="ecl-footer__menu-item ecl-list-inline__item"><a class="" href="#"><span class="ecl-icon ecl-icon--twitter ecl-footer__social-icon"></span>Twitter</a></li><li class="ecl-footer__menu-item ecl-list-inline__item"><a class="ecl-link--external" href="#"><span class=""></span>Other social media</a></li></ul></div><div class="ecl-col-sm ecl-footer__column"><ul class="ecl-footer__menu ecl-list-inline"><li class="ecl-footer__menu-item ecl-list-inline__item"><a class="" href="#"><span class=""></span>Contact</a></li><li class="ecl-footer__menu-item ecl-list-inline__item"><a class="" href="#"><span class=""></span>Site map</a></li></ul></div>';
  $footer_left = '<h4 class="ecl-h4 ecl-footer__title">European Commission</h4><ul class="ecl-footer__menu"><li class="ecl-footer__menu-item"><a class="" href="https://ec.europa.eu/commission/index_en">Commission and its priorities</a></li><li class="ecl-footer__menu-item"><a class="" href="https://ec.europa.eu/info/index_en"><span class=""></span>Policies information and services</a></li></ul>';
  $footer_middle = '<h4 class="ecl-h4 ecl-footer__title">Follow the European Commission</h4><ul class="ecl-footer__menu ecl-list-inline"><li class="ecl-footer__menu-item ecl-list-inline__item"><a class="" href="#"><span class="ecl-icon ecl-icon--facebook ecl-footer__social-icon"></span>Facebook</a></li><li class="ecl-footer__menu-item ecl-list-inline__item"><a class="" href="#"><span class="ecl-icon ecl-icon--twitter ecl-footer__social-icon"></span>Twitter</a></li><li class="ecl-footer__menu-item ecl-list-inline__item"><a class="ecl-link--external" href="#"><span class=""></span>Other social media</a></li></ul>';
  $footer_right = '<h4 class="ecl-h4 ecl-footer__title">European Union</h4><ul class="ecl-footer__menu"><li class="ecl-footer__menu-item"><a class="ecl-link--external" href="#"><span class=""></span>EU institutions</a></li><li class="ecl-footer__menu-item"><a class="ecl-link--external" href="#"><span class=""></span>European Union</a></li></ul>';
  $footer_bottom = '<ul class="ecl-list-inline ecl-footer__menu"><li class="ecl-list-inline__item ecl-footer__menu-item"><a class="" href="http://ec.europa.eu/info/about-commissions-new-web-presence_en"><span class=""></span>About the Commission\'s new web presence</a></li><li class="ecl-list-inline__item ecl-footer__menu-item"><a class="" href="http://ec.europa.eu/info/resources-partners_en"><span class=""></span>Resources for partners</a></li><li class="ecl-list-inline__item ecl-footer__menu-item"><a class="" href="http://ec.europa.eu/info/cookies_en"><span class=""></span>Cookies</a></li><li class="ecl-list-inline__item ecl-footer__menu-item"><a class="" href="http://ec.europa.eu/info/legal-notice_en"><span class=""></span>Legal notice</a></li><li class="ecl-list-inline__item ecl-footer__menu-item"><a class="" href="http://ec.europa.eu/info/contact_en"><span class=""></span>Contact</a></li><li class="ecl-list-inline__item ecl-footer__menu-item"><a class="" href="http://ec.europa.eu/info/europa-analytics_en"><span class=""></span>Europa Analytics</a></li></ul>';

  return array(
    'label' => 'Footer',
    'description' => 'Footer.',
    'preview' => array(
      'footer_left' => $footer_left,
      'footer_right' => $footer_right,
      'footer_middle' => $footer_middle,
      'footer_bottom' => $footer_bottom,
      'footer_improved' => $footer_improved,
    ),
  );
}
