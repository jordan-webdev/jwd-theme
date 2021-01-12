<?php
// Add custom fields to menu items

add_filter('wp_nav_menu_objects', 'jwd_custom_menu_items', 10, 2);

function jwd_custom_menu_items( $items, $args ) {

	foreach( $items as &$item ) {
		$icon = get_field('menu_icon', $item);
		$icon_pos = get_field('icon_position', $item);
		$is_mega = get_field("is_mega", $item);
		$mega_type = get_field("mega_type", $item);
		$mega_width = get_field("mega_width", $item);
		$is_mega_link = get_field("is_mega_link", $item);

		$title = $item->title;
		$title_class = $icon ? "menu-title menu-icon-title" : "menu-title";
		$new_title = "<span class=\"" .$title_class. "\">" .$title. "</span>";

		// Icon
		if ($icon) {
			$is_img_before = $icon_pos == "before";
			$icon_img = wp_get_attachment_image( $icon, "full", false, array("class" => "menu-icon") );
			$new_title = $is_img_before ? $icon_img . $new_title : $new_title . $icon_img;
		}

		$item->title = $new_title;

		// Mega Menu
		if ($is_mega) {
			array_push($item->classes, 'is-mega ' .$mega_type. ' ' .$mega_width);
		}

		if ($is_mega_link) {
			array_push($item->classes, 'is-mega-link');
		}
	}

	return $items;
}
