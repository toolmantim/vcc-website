<?php
/**
 * The template for displaying archived events.
 *
 * @package Victorian Climbing Club
 */

get_header(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

  <?php if (have_posts()) : ?>
    <header class="page-header">
      <h1 class="page-title">Events</h1>
    </header>

    <?php
      $args = array(
        'post_type'      => 'event',
        'posts_per_archive_page' => -1,
        'orderby'        => 'meta_value_num',
        'order'          => 'DESC',
        'meta_key'       => 'start_date',
        'meta_query'     => array(
          array(
            'key'     => 'start_date',
            'compare' => '>=',
            'value'   => date('Ymd'),
          )
        )
      );

      $result = new WP_Query($args);

      while ($result->have_posts()) {
        $result->the_post();
        get_template_part('event', 'summary');
      }
    ?>
  <?php else : ?>
    <?php get_template_part('content', 'none'); ?>
  <?php endif; ?>

  </main>
</div>
