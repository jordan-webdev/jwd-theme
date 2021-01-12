<?php
/*
 * Filters on the archive
 */

include(locate_template("template-parts/archive/_var-filters.php"));
?>

<div class="filters">
  <div class="small-filters">
    <button class="js-modal-init" type="button">
      <span class="title common-title has-triangle"><?php echo esc_html($filter_title); ?></span>
    </button>
    <div class="js-modal">
      <?php include(locate_template("template-parts/archive/part-filter-list.php")); ?>
    </div>
  </div>

  <div class="large-filters">
    <span class="title common-title"><?php echo esc_html($filter_title); ?></span>

    <?php include(locate_template("template-parts/archive/part-filter-list.php")); ?>
  </div>

</div>
