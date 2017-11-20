<?php

/**
 * @file
 * Define the display of a image file.
 */
?>
<span id="<?php print $id; ?>" class="<?php print $classes; ?> file--image"<?php print $attributes; ?>>
  <?php
  // We hide the links now so that we can render them later.
  hide($content['links']);
  print render($content);
  ?>
</span>
