<?php
/**
 * Register a custom post type for events.
 *
 * @package Victorian Climbing Club
 */

function register_events_post_type() {
  $args = array(
    'public' => true,
    'label' => 'Events',
    'supports' => array('title', 'editor')
  );
  register_post_type('event', $args);
}

add_action('init', 'register_events_post_type');
