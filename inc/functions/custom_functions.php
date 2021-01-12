<?php

// Archive pagination (derived from http://www.wpbeginner.com/wp-themes/how-to-add-numeric-pagination-in-your-wordpress-theme/)
function ajax_archive_pagination()
{
    if (is_singular()) {
        return;
    }

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if ($wp_query->max_num_pages <= 1) {
        return;
    }

    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $max   = intval($wp_query->max_num_pages);

    /**	Add current page to the array */
    if ($paged >= 1) {
        $links[] = $paged;
    }

    /**	Add the pages around the current page to the array */
    if ($paged >= 3) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if (($paged + 2) <= $max) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<nav class="pagination-wrapper js-ajax-pagination"><ul class="pagination-list">' . "\n";

    /**	Previous Post Link */
    if (get_previous_posts_link()) {
        printf('<li class="js-ajax-link-wrap">%s</li>' . "\n", get_previous_posts_link('«'));
    }

    /**	Link to first page, plus ellipses if necessary */
    if (! in_array(1, $links)) {
        $class = 1 == $paged ? ' class="current"' : '';

        printf('<li%s><a href="%s" class="js-ajax-link">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link(1)), '1');

        if (! in_array(2, $links)) {
            echo '<li class="dots">…</li>';
        }
    }

    /**	Link to current page, plus 2 pages in either direction if necessary */
    sort($links);
    foreach ((array) $links as $link) {
        $class = $paged == $link ? ' class="current"' : '';
        printf('<li%s><a href="%s" class="js-ajax-link">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($link)), $link);
    }

    /**	Link to last page, plus ellipses if necessary */
    if (! in_array($max, $links)) {
        if (! in_array($max - 1, $links)) {
            echo '<li class="dots">…</li>' . "\n";
        }

        $class = $paged == $max ? ' class="current"' : '';
        printf('<li%s><a href="%s" class="js-ajax-link">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($max)), $max);
    }

    /**	Next Post Link */
    if (get_next_posts_link()) {
        printf('<li>%s</li>' . "\n", get_next_posts_link('»'));
    }

    echo '</ul></nav>' . "\n";
}




// Pagination for pages, rather than archives
function pagination($query){ ?>
  <ul class="pagination">
    <?php
        $pages = paginate_links( array(
            'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
            'total'        => $query->max_num_pages,
            'current'      => max( 1, get_query_var( 'paged' ) ),
            'format'       => '?paged=%#%',
            'show_all'     => false,
            'type'         => 'array',
            'end_size'     => 2,
            'mid_size'     => 1,
            'prev_next'    => true,
            'prev_text'    => '<span class ="next-icon-wrap">«</span>',
            'next_text'    => '<span class ="next-icon-wrap">»</span>',
            'add_args'     => false,
            'add_fragment' => '',
        ) );

      if (is_array($pages)):
        foreach ($pages as $p): ?>
          <li class="pagination-item js-ajax-link-wrap">
            <?php echo $p; ?>
          </li>
        <?php endforeach;
      endif; ?>
  </ul>
<?php
}




// Category has parent https://stackoverflow.com/questions/19064875/how-to-check-if-a-category-has-a-parent-category
function category_has_parent($catid){
    $category = get_category($catid);
    if ($category->category_parent > 0){
        return true;
    }
    return false;
}




// Retrieve the current url of the page
function get_current_url() {
  $url = get_home_url() . $_SERVER['REQUEST_URI'];
  return $url;
}




// Get excerpt function
function get_excerpt($limit)
{
    global $post;
    $excerpt = get_the_content();
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = $excerpt.'…';
    return $excerpt;
}




/* **************************************************************************
 * get_menu_classes
 * retrieves menu item classes
 */

function get_menu_classes($menu_item){
  $classes = ( $menu_item->is_current_page ? "is-current " : false ) . ( $menu_item->is_current_page_parent ? "is-current-parent " : false );

  return $classes;
}


/* **************************************************************************
 * get_navbar_items
 * retrieves menu items, grouped with children
 * https://stackoverflow.com/questions/48219063/how-can-i-get-wp-get-nav-menu-items-to-group-child-items-with-parents
 */

function get_navbar_items($menu_id) {
    // wordpress does not group child menu items with parent menu items
    $navbar_items = wp_get_nav_menu_items($menu_id);
    $child_items = [];

    foreach ($navbar_items as $key => $item){
      // Add record for current page and set up other object properties
      $item->is_current_page = false;
      $item->is_current_page_parent = false;
      $item->child_items = array();
      $current_url = get_current_url();

      if ($current_url == $item->url){
        $item->is_current_page = true;
      }

      // pull all child menu items into separate object
      if ($item->menu_item_parent) {
          array_push($child_items, $item);
          unset($navbar_items[$key]);
      }
    }

    // Push children and add is_current_page_parent property
    foreach ($navbar_items as $item) {
      $id = $item->ID;

      // push child items into their parent item in the original object
      foreach ($child_items as $key => $child) {
        $parent_id = $child->menu_item_parent;
        $is_current_page = $child->is_current_page;

        if ($parent_id == $id){
          unset($child_items[$key]);
          array_push($item->child_items, $child);

          // If it's the current page, add the is_current_page_parent property to the parent
          if ($is_current_page){
            $item->is_current_page_parent = true;
          }
        }
      }
    }

    // return navbar object where child items are grouped with parents
    return $navbar_items;
}





// Get archive title
function jwd_get_the_archive_title(){
  $unmodified = get_the_archive_title();
  $modified = str_replace(array("Archives: ", "Category: "), "", $unmodified);

  return $modified;
}




/* **************************************************************************
 * get_image_id
 * retrieves the attachment ID from the file URL
 * https://developer.wordpress.org/reference/functions/attachment_url_to_postid/
 */

function get_image_id($image_url) {
	$img_id = attachment_url_to_postid($image_url);
  return $img_id;
}





// Remove a GET parameter and return the modified string
function remove_param($key, $sourceURL) { // Removes parameter '$key' from '$sourceURL' query string (if present)
    $url = parse_url($sourceURL);
    if (!isset($url['query'])) return $sourceURL;
    parse_str($url['query'], $query_data);
    if (!isset($query_data[$key])) return $sourceURL;
    unset($query_data[$key]);
    $url['query'] = http_build_query($query_data);
    return unparse_url($url);
}

function unparse_url($parsed_url) {
  $scheme   = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : '';
  $host     = isset($parsed_url['host']) ? $parsed_url['host'] : '';
  $port     = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : '';
  $user     = isset($parsed_url['user']) ? $parsed_url['user'] : '';
  $pass     = isset($parsed_url['pass']) ? ':' . $parsed_url['pass']  : '';
  $pass     = ($user || $pass) ? "$pass@" : '';
  $path     = isset($parsed_url['path']) ? $parsed_url['path'] : '';
  $query    = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : '';
  $fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : '';
  return "$scheme$user$pass$host$port$path$query$fragment";
}
