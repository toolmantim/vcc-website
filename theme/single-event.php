<?php
/**
 * The template for displaying a single event.
 *
 * @package Victorian Climbing Club
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

    <?php
      while (have_posts()) {
        the_post();
        get_template_part('content', get_post_format());
      }
    ?>

    <?php the_posts_navigation(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
