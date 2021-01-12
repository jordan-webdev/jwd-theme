<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function jwd_widgets_init()
{
    for ($i = 1; $i <= 9; $i++) {
        register_sidebar(array(
          'name'          => esc_html__('Widget ' .$i, 'jwd'),
          'id'            => 'widget-' .$i,
          'description'   => esc_html__('Add widgets here.', 'jwd'),
          'before_widget' => '',
          'after_widget'  => '',
          'before_title'  => '<h2 class="item-title">',
          'after_title'   => '</h2>',
      ));
    }

    for ($i = 1; $i <= 9; $i++) {
        register_sidebar(array(
          'name'          => esc_html__('Footer ' .$i, 'jwd'),
          'id'            => 'footer-' .$i,
          'description'   => esc_html__('Add widgets here.', 'jwd'),
          'before_widget' => '',
          'after_widget'  => '',
          'before_title'  => '<h2 class="item-title">',
          'after_title'   => '</h2>',
      ));
    }
}
add_action('widgets_init', 'jwd_widgets_init');
