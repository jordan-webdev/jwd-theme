<?php
/*
 * Search bar on the archive
 */

$blog_link = get_post_type_archive_link( 'post' );
?>

<div class="search">
  <div class="site-container">
    <form class="form" action="<?php echo $blog_link; ?>" method="get">
      <label for="search">Search:</label>
      <input id="search" type="text" name="s" value="" placeholder="Search...">
      <input class="submit" type="submit" value="Submit">
    </form>
  </div>
</div>
