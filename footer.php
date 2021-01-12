<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package jwd
 */

?>

	</div><!-- #content -->

	<?php //get_template_part('template-parts/part', 'go-to-top'); ?>

	<footer id="colophon" class="site-footer">
		<!-- Site Map -->
    <?php get_template_part('template-parts/footer/part', 'site-map'); ?>

		<!-- Copyright -->
		<?php get_template_part('template-parts/footer/part', 'copyright'); ?>
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
