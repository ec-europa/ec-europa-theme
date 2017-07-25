<?php

/**
 * @file
 * Contains template file.
 */
?>
<?php print render($logged_in_user); ?>
<ul<?php print $attributes; ?>><?php print render($tree); ?></ul>
