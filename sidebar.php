<?php
/**
 * The sidebar for index pages, such as blog posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package jwd
 */

$args = array(
	'taxonomy' => $tax,
  'hide_empty' => false,
	'exclude' => 1,
);
$categories = get_terms($args);
$chosen_cat = array_key_exists('cat', $_GET) ? $_GET['cat'] : false;
$include_checklist = isset($include_checklist) ? $include_checklist : false;
?>

<aside id="secondary" class="sidebar" role="complementary">
	<h2 class="title"><?php echo esc_html($title); ?></h2>

	<ul class="list">
	  <?php $i = 0; foreach ($categories as $c):
			$slug = $c->slug;
			$is_active = $i == 0 && !$_GET || $chosen_cat == $slug;
		?>
	  	<li class="item">
	  	  	<a class="link js-ajax-link js-category-selector-link <?php echo $is_active ? "active" : ""; ?>" href="<?php echo $page_url; ?>?cat=<?php echo $slug; ?>"><?php echo $c->name; ?></a>
	  	</li>
	  <?php $i++; endforeach; ?>
	</ul>

	<!-- Checklist -->
	<?php if ($include_checklist): ?>
		<div class="checklist">

			<h2 class="title"><?php echo esc_html($check_title); ?></h2>

			<div class="img-wrap">
				<?php echo wp_get_attachment_image( $img, "full", false, array("class" => "img") ); ?>
			</div>
			<a class="btn" href="<?php echo $link; ?>"><?php echo esc_html($link_text); ?></a>
		</div>
	<?php endif; ?>

</aside><!-- #secondary -->
