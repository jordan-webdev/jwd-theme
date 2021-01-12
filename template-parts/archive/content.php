<?php
$qo = get_queried_object();
$tax = $qo->taxonomy;
$is_faq = $tax == "faq_category";
?>

<?php if (!$is_faq): ?>
  <?php get_template_part('template-parts/archive/part', 'search'); ?>
<?php endif; ?>

<div class="archive-content-wrap site-container <?php echo $is_faq ? "faq-content-wrap" : false; ?>">
  <?php
    $filter_title = $is_faq ? "FAQ" : "FILTER BY";
    include(locate_template("template-parts/archive/part-filters.php"));
  ?>

  <?php if ($is_faq): ?>
    <?php get_template_part('template-parts/archive/part', 'accordions'); ?>
  <?php else: ?>
    <?php get_template_part('template-parts/archive/part', 'results'); ?>
  <?php endif; ?>
</div>
