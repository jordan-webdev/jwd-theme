<div class="post-wrap site-container">
  <?php the_post_thumbnail('full', array('class' => 'thumb')); ?>

  <h1 class="title common-title">
    <?php echo get_the_title(); ?>
  </h1>

  <div class="content">
    <?php the_content(); ?>
  </div>
</div>
