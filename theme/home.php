<?php
/**
 * The homepage template file.
 *
 * @package Victorian Climbing Club
 */

get_header('home'); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
      <?php get_sidebar('homepage-cliffcare-sidebar'); ?>

      <h1 class="home__news__heading">News</h1>

      <?php
        $news = vcc_news_query();

        while ($news->have_posts()) {
          $news->the_post();
          get_template_part('article', 'summary');
        }
      ?>

      <h1 class="home__upcoming-events__heading">Upcoming Events</h1>

      <?php
        $events_upcoming = vcc_events_upcoming_query(array('posts_per_page' => 10));
        $events_tba = vcc_events_tba_query(array('posts_per_page' => 10));

        while ($events_upcoming->have_posts()) {
          $events_upcoming->the_post();
          get_template_part('event', 'summary');
        }

        while ($events_tba->have_posts()) {
          $events_tba->the_post();
          get_template_part('event', 'summary');
        }
      ?>
    </main>
  </div>

<?php get_footer(); ?>
