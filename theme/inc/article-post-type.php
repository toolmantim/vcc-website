<?php
/**
 * Register a custom post type for news.
 *
 * @package Victorian Climbing Club
 */

/**
 * Define a custom post type.
 */
function register_article_post_type() {
  $labels = array(
    'name'          => 'News',
    'singular_name' => 'Article',
    'all_items'     => 'Articles',
    'edit_item'     => 'Edit Article'
  );
  $args = array(
    'public'            => true,
    'has_archive'       => true,
    'show_in_nav_menus' => true,
    'menu_icon'         => 'dashicons-welcome-write-blog',
    'labels'            => $labels,
    'rewrite'           => array('slug' => 'news'),
    'supports'          => array('title', 'editor')
  );
  register_post_type('article', $args);
}

add_action('init', 'register_article_post_type');

/**
 * Custom post types that have an archive page ("/news") need to flush
 * permalinks.
 */
function article_rewrite_rules_flush() {
  register_article_post_type();
  flush_rewrite_rules();
}

add_action('after_switch_theme', 'article_rewrite_rules_flush');
