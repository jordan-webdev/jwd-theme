<?php
// Taxonomy template

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php
				//$qo = get_queried_object();
			  //$title = strtoupper($qo->name);
			  //include(locate_template("template-parts/part-inner-hero.php"));
			?>

			<?php get_template_part('template-parts/archive/content', ''); ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
