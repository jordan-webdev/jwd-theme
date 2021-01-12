<?php
//Theme Options
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'    => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'        => false
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Header Settings',
        'menu_title'    => 'Header',
        'parent_slug'    => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Footer Settings',
        'menu_title'    => 'Footer',
        'parent_slug'    => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Common Icon Settings',
        'menu_title'    => 'Common Icons',
        'parent_slug'    => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Google Maps',
        'menu_title'    => 'Google Maps',
        'parent_slug'    => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Module Settings',
        'menu_title'    => 'Modules',
        'parent_slug'    => 'theme-general-settings',
    ));

    /*acf_add_options_sub_page(array(
        'page_title'    => 'Theme Schema Settings',
        'menu_title'    => 'Schema',
        'parent_slug'    => 'theme-general-settings',
    ));*/
}




// Blocks
function register_acf_block_types() {

    // Case Study Info
    /*acf_register_block_type(array(
        'name'              => 'casestudyinfo',
        'title'             => __('Case Study Info'),
        'description'       => __('Text beside icons with information.'),
        'render_template'   => 'template-parts/blocks/case_study_info.php',
        'category'          => 'common',
        'icon'              => 'media-document',
        'keywords'          => array( 'case', 'study', 'info' ),
    ));*/
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_acf_block_types');
}




// Dynamic locations selector based on options repeater
function acf_load_social_location_choices($field) {
  // reset choices
  $field['choices'] = array();

  $locations = get_field("locations", "options");
  foreach ($locations as $loc) {
    $label = $loc['location'];
    $value = location_str_replace($label);

    $field['choices'][ $value ] = $label;
  }

  return $field;
}
add_filter('acf/load_field/name=dyn_loc', 'acf_load_social_location_choices');
//add_filter('acf/load_field/name=social_media_to_use', 'acf_load_social_media_choices');




//Dynamic product filter options
function acf_dynamic_select_from_textarea($field)
{

    // reset choices
    $field['choices'] = array();

    // get the textarea value from options page without any formatting
    $choices = get_field('post_product_options', 'option', false);

    // explode the value so that each line is a new array piece
    $choices = explode("\n", $choices);

    // remove any unwanted white space
    $choices = array_map('trim', $choices);

    // loop through array and add to field 'choices'
    if (is_array($choices)) {
        foreach ($choices as $choice) {
            $field['choices'][ $choice ] = $choice;
        }
    }

    // return the field
    return $field;
}
//add_filter('acf/load_field/name=search_filters_label', 'acf_dynamic_select_from_textarea');




// category ancestor location rule
add_filter('acf/location/rule_types', 'acf_location_types_category_ancestor');
function acf_location_types_category_ancestor($choices)
{
    if (!isset($choices['Post']['post_category_ancestor'])) {
        $choices['Post']['post_category_ancestor'] = 'Post Category Ancestor';
    }
    return $choices;
}

add_filter('acf/location/rule_values/post_category_ancestor', 'acf_location_rule_values_category_ancestor');
function acf_location_rule_values_category_ancestor($choices)
{
    // copied from acf rules values for post_category
    $terms = acf_get_taxonomy_terms('category');
    if (!empty($terms)) {
        $choices = array_pop($terms);
    }
    return $choices;
}

add_filter('acf/location/rule_match/post_category_ancestor', 'acf_location_rule_match_category_ancestor', 10, 3);
function acf_location_rule_match_category_ancestor($match, $rule, $options)
{
    // most of this copied directly from acf post category rule
    $terms = 0;
    if (array_key_exists('post_taxonomy', $options)){
      $terms = $options['post_taxonomy'];
    }
    $data = acf_decode_taxonomy_term($rule['value']);
    $term = get_term_by('slug', $data['term'], $data['taxonomy']);
    if (!$term && is_numeric($data['term'])) {
        $term = get_term_by('id', $data['term'], $data['taxonomy']);
    }
    // this is where it's different than ACf
    // get terms so we can look at the parents
    if (is_array($terms)) {
        foreach ($terms as $index => $term_id) {
            $terms[$index] = get_term_by('id', intval($term_id), $term->taxonomy);
        }
    }

    if (array_key_exists('post_id', $options)){
      if (!is_array($terms) && $options['post_id']) {
          $terms = wp_get_post_terms(intval($options['post_id']), $term->taxonomy);
      }
    }
    if (!is_array($terms)) {
        $terms = array($terms);
    }
    $terms = array_filter($terms);
    $match = false;
    // collect a list of ancestors
    $ancestors = array();
    if (count($terms)) {
        foreach ($terms as $term_to_check) {
            $ancestors = array_merge(get_ancestors($term_to_check->term_id, $term->taxonomy));
        } // end foreach terms
    } // end if
    // see if the rule matches any term ancetor
    if ($term && in_array($term->term_id, $ancestors)) {
        $match = true;
    }

    if ($rule['operator'] == '!=') {
        // reverse the result
        $match = !$match;
    }
    return $match;
}




// Show WP custom field metabox
add_filter('acf/settings/remove_wp_meta_box', '__return_false');




/* *****************************************************
 * ********** Custom fields for specific category
 * *****************************************************
 */

add_filter('acf/location/rule_types', 'acf_location_rules_types', 999);
function acf_location_rules_types($choices) {
    // create a new group for the rules called Terms
    // if it does not already exist
    if (!isset($choices['Terms'])) {
        $choices['Terms'] = array();
    }
    // create new rule type in the new group
    $choices['Terms']['category_id'] = 'Category Name';
    return $choices;
}

add_filter('acf/location/rule_values/category_id', 'acf_location_rules_values_category');
function acf_location_rules_values_category($choices) {
    // get terms and build choices
    $taxonomy = 'category';
    $args = array('hide_empty' => false);
    $terms = get_terms($taxonomy, $args);
    if (count($terms)) {
        foreach ($terms as $term) {
            $choices[$term->term_id] = $term->name;
        }
    }
    return $choices;
}

add_filter('acf/location/rule_match/category_id', 'acf_location_rules_match_category', 10, 3);
function acf_location_rules_match_category($match, $rule, $options) {
    if (!isset($_GET['tag_ID']) ||
            !isset($_GET['taxonomy']) ||
            $_GET['taxonomy'] != 'category') {
        // bail early
        return $match;
    }
    $term_id = $_GET['tag_ID'];
    $selected_term = $rule['value'];
    if ($rule['operator'] == '==') {
        $match = ($selected_term == $term_id);
    } elseif ($rule['operator'] == '!=') {
        $match = ($selected_term != $term_id);
    }
    return $match;
}
