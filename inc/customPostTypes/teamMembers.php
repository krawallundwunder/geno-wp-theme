<?php

namespace Flynt\CustomPostTypes;

add_action('init', function (): void {
  $labels = [
    'name' => _x('Team Members', 'Post Type General Name', 'flynt'),
    'singular_name' => _x('Team Member', 'Post Type Singular Name', 'flynt'),
    'menu_name' => __('Team Members', 'flynt'),
    'name_admin_bar' => __('Team Member', 'flynt'),
    'archives' => __('Item Archives', 'flynt'),
    'attributes' => __('Item Attributes', 'flynt'),
    'parent_item_colon' => __('Parent Item:', 'flynt'),
    'all_items' => __('All Items', 'flynt'),
    'add_new_item' => __('Add New Team Member', 'flynt'),
    'add_new' => __('Add New', 'flynt'),
    'new_item' => __('New Team Member', 'flynt'),
    'edit_item' => __('Edit Team Member', 'flynt'),
    'update_item' => __('Update Team Member', 'flynt'),
    'view_item' => __('View Team Member', 'flynt'),
    'view_items' => __('View Team Members', 'flynt'),
    'search_items' => __('Search Team Members', 'flynt'),
    'not_found' => __('Not found', 'flynt'),
    'not_found_in_trash' => __('Not found in Trash', 'flynt'),
    'featured_image' => __('Featured Image', 'flynt'),
    'set_featured_image' => __('Set featured image', 'flynt'),
    'remove_featured_image' => __('Remove featured image', 'flynt'),
    'use_featured_image' => __('Use as featured image', 'flynt'),
    'insert_into_item' => __('Insert into item', 'flynt'),
    'uploaded_to_this_item' => __('Uploaded to this item', 'flynt'),
    'items_list' => __('Items list', 'flynt'),
    'items_list_navigation' => __('Items list navigation', 'flynt'),
    'filter_items_list' => __('Filter items list', 'flynt'),
  ];

  $args = [
    'label' => __('Team Members', 'flynt'),
    'description' => __('A Post Type for Team Members', 'flynt'),
    'labels' => $labels,
    'supports' => ['title', 'revisions'],
    'taxonomies' => [],
    'hierarchical' => false,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 20,
    'menu_icon' => 'dashicons-groups',
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => false,
    'can_export' => true,
    'has_archive' => false,
    'exclude_from_search' => true,
    'publicly_queryable' => false,
    'capability_type' => 'page',
  ];

  register_post_type('team_member', $args);
});
