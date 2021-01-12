<?php
/*
 * Mod: Pagination
 */
?>

<div class="pagination" data-results="#results">
  <?php if ($numbers > 1): ?>
    <ul class="list">
      <?php $i = 1; while ($i <= $numbers) : ?>
        <li class="item">
          <button class="btn <?php echo $i == 1 ? "active" : false; ?>" type="button" data-result-set="<?php echo $i; ?>">
            <span class="screen-reader-text">Display result set <?php echo $i; ?></span>

            <span class="count"><?php echo $i; ?></span>
          </button>
        </li>
      <?php $i++; endwhile; ?>
    </ul>
  <?php endif; ?>
</div>
