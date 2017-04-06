<?php

/**
 * @file
 * Contains template file.
 */
?>
<?php foreach ($status_messages['status_messages'] as $type => $data): ?>
  <?php print render($data); ?>
<?php endforeach; ?>

