<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package jwd
 */

$is_entry_content = true;
?>

<?php get_template_part('template-parts/modules/breadcrumb/mod', 'breadcrumb'); ?>

<article id="post-<?php the_ID(); ?>">


  <div class="content-wrap">
    <?php if ($is_entry_content): ?>
      <div class="entry-content clear">
    <?php endif; ?>
			<?php the_content(); ?>
    <?php if ($is_entry_content): ?>
      </div>
    <?php endif; ?>
  </div>


	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'jwd' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
