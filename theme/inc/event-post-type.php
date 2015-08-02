<?php
/**
 * Register a custom post type for events.
 *
 * @package Victorian Climbing Club
 */

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
    'labels'            => $labels,
    'rewrite'           => array('slug' => 'events'),
    'supports'          => array('title', 'editor')
  );
  register_post_type('event', $args);
}

add_action('init', 'register_event_post_type');

function my_rewrite_flush() {
  register_event_post_type();
  flush_rewrite_rules();
}

add_action('after_switch_theme', 'my_rewrite_flush');
