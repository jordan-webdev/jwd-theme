<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package jwd
 */

$template = get_template_directory_uri();
$images = $template . '/images';
$body_class = is_home() ? "archive" : false;

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class($body_class); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'jwd'); ?></a>


	<header id="masthead" class="site-header">

    <!-- Desktop Nav -->
    <?php get_template_part('template-parts/header/part', 'nav-desktop'); ?>
		<!-- Sticky Nav (Desktop) -->
		<?php //get_template_part('template-parts/header/part', 'sticky-nav'); ?>
		<!-- Mobile Nav -->
		<?php get_template_part('template-parts/header/part', 'header-mobile'); ?>

	</header><!-- #masthead -->


	<div id="content" class="site-content">
