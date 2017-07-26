<?php

use Drupal\DrupalExtension\Context\RawDrupalContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends RawDrupalContext {

  /**
   * Function Node of Type.
   *
   * @Given :amount nodes of type :type
   */
  public function nodesOfType($amount, $type) {
    for ($i = 0; $i < $amount; $i++) {
      $node = (object) [
        'type' => $type,
        'title' => ucfirst($type) . " " . $i,
      ];
      $this->nodeCreate($node);
    }
  }

}
