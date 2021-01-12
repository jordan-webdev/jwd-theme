<?php
/*
 * Accordions on the Archive
 */
?>

<div class="accordions">
  <?php if ( have_posts() ): ?>

    <!-- List -->
    <ul class="list">
      <?php $i = 0; while ( have_posts() ) : the_post();
        $accordion_id = "faq_" .$i;
      ?>
        <li class="item">
          <div id="<?php echo $accordion_id; ?>" class="accordion">
            <?php
              $title = get_the_title();
              include(locate_template("template-parts/modules/mod-accordion-btn.php"));
            ?>

            <div class="accordion-pullout">
              <?php the_content(); ?>
            </div>
          </div>
        </li>
      <?php $i++; endwhile; ?>
    </ul>

  <?php else: ?>
    <!-- No Results -->
    <p class="no-results-msg">No results found.</p>
  <?php endif; ?>
</div>
