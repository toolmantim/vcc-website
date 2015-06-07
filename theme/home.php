<?php
/**
 * The homepage template file.
 *
 * @package Victorian Climbing Club
 */

get_header(); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
      <h3>News</h3>

      <?php
        while (have_posts()) {
          the_post();
          get_template_part('content', get_post_format());
        }
      ?>

      <h3>Events</h3>

      TODO
    </main>
  </div>

<?php get_footer(); ?>
