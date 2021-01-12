<?php
// Blog posts archive

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php
				$is_search = array_key_exists("s", $_GET);
				$qo = get_queried_object();

				$title = !$is_search ? $qo->post_title : 'Search: ' .get_search_query();
			  $title = strtoupper($title);
			  include(locate_template("template-parts/part-inner-hero.php"));
			?>

			<?php get_template_part('template-parts/archive/content', ''); ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
