<?php
/*
 * Inner Hero for pages
 */

$hero = get_field("inner_hero");
$title = $hero['title'];
$title = $title ? $title : get_the_title();
?>

<div class="inner-hero">
  <h1 class="title"><?php echo $title; ?></h1>
</div>
