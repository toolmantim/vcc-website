<?php
/**
 * Adds a query function for fetching news
 */
function vcc_news_query() {
  $args = array(
    'nopaging'  => true,
    'post_type' => 'post',
    'orderby'   => 'date',
    'order'     => 'DESC'
  );

  return new WP_Query($args);
}

/**
 * Adds a query function for fetching upcoming events
 */
function vcc_events_upcoming_query($query_args = array()) {
  $args = array_merge($query_args, array(
    'post_type'      => 'event',
    'meta_key'       => 'start_date',
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
    'meta_query'     => array(
      array(
        'key'     => 'start_date',
        'compare' => '>=',
        'value'   => date('Ymd'),
      )
    )
  ));

  return new WP_Query($args);
}

function vcc_events_tba_query($query_args = array()) {
  $args = array_merge($query_args, array(
    'post_type'      => 'event',
    'order'          => 'ASC',
    'meta_query'     => array(
      array(
        'key'   => 'start_date',
        'value' => false,
        'type'  => 'BOOLEAN'
      )
    )
  ));

  return new WP_Query($args);
}

function vcc_events_past_query() {
  $args = array(
    'post_type'              => 'event',
    'posts_per_archive_page' => -1,
    'orderby'                => 'meta_value_num',
    'order'                  => 'DESC',
    'meta_key'               => 'start_date',
    'meta_query'             => array(
      'relation' => 'AND',
      array(
        'key'     => 'start_date',
        'compare' => '<',
        'value'   => date('Ymd'),
      ),
      array(
        'compare' => '!=',
        'key'     => 'start_date',
        'value'   => false,
        'type'    => 'BOOLEAN'
      )
    )
  );

  return new WP_Query($args);
}
?>
