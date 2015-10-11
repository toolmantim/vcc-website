<?php
/**
 * The homepage template file.
 *
 * @package Victorian Climbing Club
 */

get_header(); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
      <h1>News</h1>

      <?php
        while (have_posts()) {
          the_post();
          get_template_part('content', get_post_format());
        }
      ?>

      <h1>Events</h1>

      <?php
        $args = array('post_type' => 'event', 'posts_per_page' => 10);
        $result = new WP_Query($args);

        while ($result->have_posts()) {
          $result->the_post();
          get_template_part('content-event', get_post_format());
        }
      ?>
    </main>
  </div>

<?php get_footer(); ?>
