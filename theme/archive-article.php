<?php
/**
 * The template for displaying the news archive.
 *
 * Template Name: News Archive
 *
 * @package Victorian Climbing Club
 */

get_header(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">
    <?php if (have_posts()) : ?>
      <header class="page-header">
        <h1 class="page-title">News</h1>
      </header>

      <?php
        $args = array(
          'post_type'              => 'post',
          'posts_per_archive_page' => -1,
          'orderby'                => 'date',
          'order'                  => 'DESC'
        );

        $result = new WP_Query($args);

        while ($result->have_posts()) {
          $result->the_post();
          get_template_part('article', 'summary');
        }
      ?>
    <?php else : ?>
      <?php get_template_part('content', 'none'); ?>
    <?php endif; ?>
  </main>
</div>

<?php get_footer(); ?>
