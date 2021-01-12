<?php
/*
 * Main Slider. Multi slider that supports IMG and Video.
 * Usually used on the home page
 */

$main_slider = get_field("main_slider");
$slider = $main_slider['slider'];
?>

<div class="main-slider common-slider">
  <div class="slider">

    <?php foreach ($slider as $slide):
      $img = $slide['img'];
      $vid = $slide['vid'];
    ?>
      <div class="slide">

        <div class="media-wrap">
          <!-- IMG Slide -->
          <?php if ($img): ?>
            <?php echo wp_get_attachment_image( $img, "full", false, array("class" => "img") ); ?>
          <?php endif; ?>

          <!-- Video slide -->
          <?php if ($vid): ?>
            <video class="vid" loop playsinline muted poster="">
              <source src="<?php echo esc_url($vid); ?>" type="video/mp4">
            </video>
          <?php endif; ?>
        </div>

      </div>
    <?php endforeach; ?>

  </div>
</div>
