<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package jwd
 */

$is_hero = true;

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php if ($is_hero): ?>
				<?php get_template_part('template-parts/part', 'inner-hero'); ?>
			<?php endif; ?>

			<div class="page-wrapper">
				<?php while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content', 'page' );
				endwhile; ?>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
