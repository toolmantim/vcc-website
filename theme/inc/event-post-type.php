<?php
/**
 * Register a custom post type for events.
 *
 * @package Victorian Climbing Club
 */

function register_events_post_type() {
  $args = array(
    'public' => true,
    'has_archive' => true,
    'label' => 'Events',
    'rewrite' => array('slug' => 'events'),
    'supports' => array('title', 'editor')
  );
  register_post_type('event', $args);
}

add_action('init', 'register_events_post_type');
add_action('after_switch_theme', 'flush_rewrite_rules');
