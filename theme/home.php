<?php
/**
 * The homepage template file.
 *
 * @package Victorian Climbing Club
 */

get_header(); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

      <?php get_sidebar( 'homepage-cliffcare-sidebar' ); ?>

      <h1>News</h1>

      <?php
        while (have_posts()) {
          the_post();
          get_template_part('content', get_post_format());
        }
      ?>

      <h1>Upcoming Events</h1>

      <?php
        $args = array(
          'post_type' => 'event',
          'posts_per_page' => 10,
          'meta_key' => 'start_date',
          'orderby' => 'meta_value_num',
          'order' => 'ASC',
          'meta_query' => array(
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
          get_template_part('content-event', get_post_format());
        }
      ?>
    </main>
  </div>

<?php get_footer(); ?>
