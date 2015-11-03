<?php
/**
 * The template for displaying a single article.
 *
 * @package Victorian Climbing Club
 */

get_header(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">
    <?php
      while (have_posts()) {
        the_post();
        get_template_part('article', 'single');
      }
    ?>

    <?php the_posts_navigation(); ?>
  </main>
</div>

<?php get_footer(); ?>
