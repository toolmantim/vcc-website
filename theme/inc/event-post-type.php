<?php
/**
 * Register a custom post type for events.
 *
 * @package Victorian Climbing Club
 */

// Define our post type

function register_event_post_type() {
  $labels = array(
    'name'          => 'Events',
    'singular_name' => 'Event',
    'add_new_item'  => 'Add New Event'
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

// Custom types that have an archive page ("/events") need to flush permalinks
// like this

function event_rewrite_rules_flush() {
  register_event_post_type();
  flush_rewrite_rules();
}

add_action('after_switch_theme', 'event_rewrite_rules_flush');

// Define the table columns for the events admin

function add_event_columns($columns) {
    return array_merge($columns,
      array('location'     => __('Location'),
            'start_date'   =>__( 'Event Date'),
            'duration'     =>__( 'Duration'),
            'contact_name' =>__( 'Contact Name')));
}

add_filter('manage_event_posts_columns', 'add_event_columns');

// Define the table columns are printed for the events admin

function custom_event_column( $column ) {
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
      if ($start_date && $time) {
        echo $start_date->format('j M Y') . " @ " . $time;
      } elseif ($start_date) {
        echo $start_date->format('j M Y');
      } else {
        echo 'TBA';
      }
      break;
    case 'contact_name':
      echo get_field('contact_name');
      break;
    case 'duration':
      echo get_field('duration');
      break;
  }
}

add_filter('manage_event_posts_custom_column', 'custom_event_column');
