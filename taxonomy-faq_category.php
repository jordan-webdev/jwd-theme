<?php
// FAQ Category template

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php
				$qo = get_queried_object();
        $mod = get_field('inner_hero', 'faq_category_' . $qo->term_id);
        $args = array(
          'mod' => $mod,
          'title' => strtoupper($qo->name),
        );
        get_template_part('modules/mod', 'inner-hero', $args);
			?>

			<?php get_template_part('template-parts/archive/content', ''); ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
