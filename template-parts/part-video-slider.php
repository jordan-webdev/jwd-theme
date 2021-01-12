<?php
/*
 * A large video slider, controlled by buttons with icons and progress bars
 */

$template = get_template_directory_uri();
$gallery = get_field("video_slider");
?>

<section class="video-slider">

  <!-- Slides -->
	<?php $i = 0; foreach ($gallery as $gal):
		$title = $gal['title'];
    $clean_title = str_replace(array('<p>', '</p>'), array('', '<br>'), $title);
		//$text = $gal['text'];
	?>

		<div class="slide <?php echo $i == 0 ? "active" : false; ?>">

			<video class="video js-active-toggle <?php echo $i == 0 ? "active" : false; ?>" autoplay muted playsinline>
				<source src="<?php echo esc_url($gal['video']); ?>" type="video/mp4">
			</video>

			<div class="slide-content">
				<h1 class="title js-active-toggle <?php echo $i == 0 ? "active" : false; ?>"><?php echo $clean_title; ?></h1>

				<!--<div class="text js-active-toggle <?php //echo $i == 0 ? "active" : false; ?>"><?php //echo esc_html($text); ?></div>-->
			</div>

		</div>

	<?php $i++; endforeach; ?>


	<!-- Video Navigation -->
	<ul class="nav">
		<?php $count = count($gallery); $i = 0; while ($i < $count): ?>
			<li class="nav-item js-active-toggle">
				<button class="nav-btn" type="button">
					<span class="layout">
						<span class="nav-icon-wrap">
							<?php echo wp_get_attachment_image( $gallery[$i]['nav_icon'], "full", false, array("class" => "nav-icon") ); ?>
						</span>
					</span>
				</button>

				<!--<a class="nav-link js-active-toggle" href="<?php //echo esc_url($gallery[$i]['nav_link']); ?>">VIEW PRODUCTS</a>-->

				<div id="progress-bar-<?php echo $i; ?>" class="nav-progress-bar">

				</div>
			</li>
		<?php $i++; endwhile; ?>
	</ul>

	<!-- Scroll Down Animation -->
	<?php get_template_part('template-parts/part', 'scroll-animation'); ?>

</section>
