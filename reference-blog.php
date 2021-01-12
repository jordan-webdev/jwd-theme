<?php
/**
* Template Name: Blog
* The template for displaying an index of blog posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package jwd
 */
get_header();
?>

<main class="site-main padding-site">
  <div class="container-site">

    <div class="blog-index grid-x grid-margin-x">
      <!-- Categories -->
    	<div class="cell medium-5 large-4">
    		<?php
          $sidebar = get_field("sidebar");
          $tax = "blog_category";
          $title = $sidebar['title'];
          $page_url = get_the_permalink();
          include(locate_template("template-parts/part-category-sidebar.php"));
        ?>
    	</div>

      <!-- Results -->
			<?php
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$chosen_cat = array_key_exists('cat', $_GET) ? $_GET['cat'] : false;
			$args = array(
				'post_type' => 'blog_post',
				'posts_per_page' => 5,
				'paged' => $paged,
			);

      if ($chosen_cat) {
        $args['tax_query'] = array(
          array(
            'taxonomy' => 'blog_category',
      			'field'    => 'slug',
      			'terms'    => $chosen_cat,
          ),
        );
      }

			$query = new WP_Query($args);

			if ( $query->have_posts() ): ?>
	    	<div id="js-ajax-scroll-to" class="cell medium-7 large-8 blog-list js-ajax-content-container">

					<div class="js-ajax-results">
						<ul class="list">
							<?php while ( $query->have_posts() ): $query->the_post(); ?>
					     	<li class="item">
					     	  <?php get_template_part('template-parts/blog/part', 'blog-list-item'); ?>
					     	</li>
				   		<?php endwhile; ?>
		    		</ul>

						<?php pagination($query); ?>
					</div>

	    	</div>
			<?php endif; wp_reset_postdata(); ?>
    </div>

  </div>
</main>

<?php
get_footer();
?>
