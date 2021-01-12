<?php
// Search archive

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php
				$hero_title = strtoupper('Search: ' .get_search_query());

			  include(locate_template("template-parts/part-inner-hero.php"));
			?>

			<?php get_template_part('template-parts/archive/content', ''); ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
