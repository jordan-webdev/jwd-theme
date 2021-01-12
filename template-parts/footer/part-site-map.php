<?php
/*
 * Sitemap
 */
?>

<?php
$grouped_items = array();
$all_items = array();


?>

<!-- Desktop -->
<section class="sitemap">
  <ul class="list">
    <?php for ($i = 1; $i <= 9; $i++) {
      if (is_active_sidebar('footer-' .$i)): ?>
        <li class="item">
          <?php dynamic_sidebar('footer-' .$i); ?>
        </li>
      <?php endif;
    } ?>
  </ul>
</section>
