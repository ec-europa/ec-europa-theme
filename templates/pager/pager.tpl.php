<?php

/**
 * @file
 * Contains template file.
 */
?>
<?php if (!empty($pager)): ?>
<div class="ecl-pager__wrapper">
  <ul class="ecl-pager">

    <?php if (isset($links['pager_previous'])): ?>
      <li class="ecl-pager__item ecl-pager__item--previous">
        <a class="ecl-pager__link" title="<?php print $previous_title ?>" href="<?php print $links['pager_previous']['url'] ?>"><?php print $previous_label ?></a>
      </li>
    <?php endif ?>

    <?php for ($cursor = $pager_first; $cursor <= $pager_last; $cursor++): ?>

      <?php if (($pager_last - $quantity >= 1) && $cursor == $pager_first): ?>
        <li class="ecl-pager__item ecl-pager__item--first">
          <a class="ecl-pager__link" title="<?php print $goto_title ?> 1" href="<?php print $links['pager_first']['url'] ?>">1</a>
        </li>
        <?php if ($pager_last - $quantity > 1): ?>
          <li class="ecl-pager__item ecl-pager__item--ellipsis">…</li>
        <?php endif ?>
      <?php endif ?>

      <?php if ($cursor == $pager_current): ?>
        <li class="ecl-pager__item ecl-pager__item--current"><span class="ecl-pager__item-text"><?php print $page_label ?></span> <?php print $pager_current ?></li>
      <?php else: ?>
        <li class="ecl-pager__item">
          <a class="ecl-pager__link" title="<?php print $goto_title ?> <?php print $links['pager_link__' . $cursor]['label'] ?>" href="<?php print $links['pager_link__' . $cursor]['url'] ?>"><?php print $links['pager_link__' . $cursor]['label'] ?></a>
        </li>
      <?php endif ?>

      <?php if (($pager_first + $quantity < $pager_max) && $cursor == $pager_last): ?>
        <li class="ecl-pager__item ecl-pager__item--ellipsis">…</li>
        <li class="ecl-pager__item ecl-pager__item--last">
          <a class="ecl-pager__link" title="<?php print $goto_title ?> <?php print $pager_max ?>" href="<?php print $links['pager_last']['url'] ?>"><?php print $pager_max ?></a>
        </li>
      <?php endif ?>

    <?php endfor ?>

    <?php if (isset($links['pager_next'])): ?>
      <li class="ecl-pager__item ecl-pager__item--next">
        <a class="ecl-pager__link" title="<?php print $next_title ?>" href="<?php print $links['pager_next']['url'] ?>"><?php print $next_label ?></a>
      </li>
    <?php endif ?>
  </ul>
</div>
<?php endif ?>
