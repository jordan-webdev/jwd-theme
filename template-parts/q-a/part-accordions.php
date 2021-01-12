<?php
/**
 * Template part for displaying taxonomy posts in the style of accordions.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package jwd
 */

?>

<article class="accordions__accordion">
	<header class="accordions__toggler">
		<h2 class="accordions__title"><?php echo get_the_title(); ?></h2>
    <img class="accordions__arrow" src="<?php echo get_template_directory_uri(); ?>/images/faq-arrow-min.png" alt="click to expand the answer" />
	</header>
	<div class="accordions__pullout">
		<?php the_content(); ?>
	</div>
</article>
