<?php

/**
 * @file
 * Overriders the freepager template.
 */
?>
<?php if (!empty($previous)): ?>
  <li class="ecl-pager__item ecl-pager__item--previous">
    <?php print $previous_linked; ?>
  </li>
<?php endif; ?>
<?php if (!empty($next)): ?>
  <li class="ecl-pager__item ecl-pager__item--next">
    <?php print $next_linked; ?>
  </li>
<?php endif; ?>
<?php if (!empty($current)): ?>
  <li class="ecl-pager__item ecl-pager__item--current">
    <?php print $current; ?>
  </li>
<?php endif; ?>
