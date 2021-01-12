<?php
/*
 * Results on the archive
 */

$per_page = 3;
?>

<div id="results" class="results">
  <?php if ( have_posts() ): ?>

    <!-- List -->
    <ul class="list">
      <?php $i = 0; while ( have_posts() ) : the_post(); ?>
        <li class="item <?php echo $i < $per_page ? "active" : "none"; ?>" data-result-set="<?php echo ceil(($i + 1) / $per_page) ?>">
          <div class="img-wrap">
            <?php the_post_thumbnail('medium', array('class' => 'img')); ?>
          </div>

          <div class="content">
            <h2 class="title">
              <?php echo get_the_title(); ?>
            </h2>

            <div class="excerpt">
              <?php the_excerpt(); ?>
            </div>

            <a class="link" href="<?php echo the_permalink(); ?>">
              READ MORE
            </a>
          </div>
        </li>
      <?php $i++; endwhile; ?>
    </ul>

  <?php else: ?>
    <!-- No Results -->
    <p class="no-results-msg">No results found.</p>
  <?php endif; ?>
</div>

<!-- Pagination -->
<?php
  $count = $i ?? false;
  if ($count) {
    $numbers = ceil($count / $per_page);
    include(locate_template("template-parts/modules/mod-pagination.php"));
  }
?>
