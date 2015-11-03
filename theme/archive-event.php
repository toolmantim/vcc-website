<?php
/**
 * The template for displaying the events archive.
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

      <nav>
        <a href="#upcoming">Upcoming</a>
        <a href="#previous">Previous</a>
      </nav>

      <h2 id="upcoming">Upcoming</h2>

      <?php
        $args = array(
          'post_type'              => 'event',
          'posts_per_archive_page' => -1,
          'orderby'                => 'meta_value_num',
          'order'                  => 'ASC',
          'meta_key'               => 'start_date',
          'meta_query'             => array(
            'relation' => 'OR',
            array(
              'key'     => 'start_date',
              'compare' => '>=',
              'value'   => date('Ymd'),
            ),
            array(
              'key'   => 'start_date',
              'value' => false,
              'type'  => 'BOOLEAN'
            )
          )
        );

        $result = new WP_Query($args);

        while ($result->have_posts()) {
          $result->the_post();
          get_template_part('event', 'summary');
        }
      ?>

      <h2 id="previous">Previous</h2>

      <?php
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

<?php get_footer(); ?>
