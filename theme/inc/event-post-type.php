<?php
/**
 * Register a custom post type for events.
 *
 * @package Victorian Climbing Club
 */

/**
 * Define a custom post type.
 */
function register_event_post_type() {
  $labels = array(
    'name'          => 'Events',
    'singular_name' => 'Event',
    'edit_item'     => 'Edit Event'
  );
  $args = array(
    'public'            => true,
    'has_archive'       => true,
    'show_in_nav_menus' => true,
    'menu_icon'         => 'dashicons-calendar-alt',
    'labels'            => $labels,
    'rewrite'           => array('slug' => 'events'),
    'supports'          => array('title', 'editor')
  );
  register_post_type('event', $args);
}

add_action('init', 'register_event_post_type');

/**
 * Custom post types that have an archive page ("/news") need to flush
 * permalinks.
 */
function event_rewrite_rules_flush() {
  register_event_post_type();
  flush_rewrite_rules();
}

add_action('after_switch_theme', 'event_rewrite_rules_flush');

/**
 * Define the table columns for the events admin.
 */
function add_event_custom_columns($columns) {
  return array_merge($columns,
    array('start_date'      =>__( 'Event Date'),
          'location'        => __('Location'),
          'contact_name'    =>__( 'Contact'),
          'contact_details' =>__('Contact Details'),
          'photos' =>__( 'Photos')));
}

add_filter('manage_event_posts_columns', 'add_event_custom_columns');

/**
 * Define the table columns are printed for the events admin.
 */
function event_custom_column( $column ) {
  global $post;

  switch ( $column ) {
    case 'location':
      $location_name = get_field('location_name');
      if ($location_name) {
        echo $location_name;
      } else {
        echo 'TBA';
      }
      break;
    case 'start_date':
      $start_date = DateTime::createFromFormat('Ymd', get_field('start_date'));
      $time = get_field('time');
      $end_date = DateTime::createFromFormat('Ymd', get_field('end_date'));

      if ($start_date) {
        echo $start_date->format('j M Y');
      } else {
        echo 'TBA';
      }

      if ($end_date) {
        echo " — " . $end_date->format('j M Y');
      }

      if ($time) {
        echo " @ " . $time;
      }

      break;
    case 'contact':
      echo get_field('contact_name');
      break;
    case 'contact_details':
      if (get_field('contact_email')) {
        echo 'Email';
      }
      if (get_field('contact_phone')) {
        echo 'Phone';
      }
      break;
    case 'photos':
      $photos_url = get_field('photos_url');
      if ($photos_url) {
        echo 'Yes';
      } else {
        echo 'No';
      }
      break;
  }
}

add_filter('manage_event_posts_custom_column', 'event_custom_column');

/**
 * Make the columns sortable.
 */
function event_sortable_columns($columns) {
  return array_merge($columns, array(
    'start_date'   => 'start_date',
    'location'     => 'location',
    'contact_name' => 'contact_name',
    'photos'       => 'photos',
  ));
}

add_filter('manage_edit-event_sortable_columns', 'event_sortable_columns');
