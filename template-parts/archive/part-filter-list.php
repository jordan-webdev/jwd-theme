<ul class="list">
  <?php if (!$is_faq): ?>
    <li class="item">
      <a class="link <?php echo $is_all_match ? "match" : false; ?>" href="<?php echo $all_link; ?>">
        All
      </a>
    </li>
  <?php endif; ?>

  <?php foreach ($filters as $filter):
    $id = $filter->term_id;
    $link = get_category_link($id);
    $is_match = $link == $page_link;
  ?>
    <li class="item">
      <a class="link <?php echo $is_match ? "match" : false; ?>" href="<?php echo $link; ?>">
        <?php echo $filter->name; ?>
      </a>
    </li>
  <?php endforeach; ?>
</ul>
