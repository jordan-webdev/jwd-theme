<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package jwd
 */

$query_obj = get_queried_object();
$categories = get_categories( array(
    'parent'  => 0 //this parameter is important for top level category
    )
);
$ancestor_category = $categories[0]->term_id;

$title = get_the_title();
?>

<article id="post-<?php the_ID(); ?>" <?php body_class(); ?>>

  <?php the_title(); ?>

</article><!-- #post-## -->
