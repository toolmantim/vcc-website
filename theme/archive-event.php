<?php
/**
 * The template for displaying the events archive.
 *
 * @package Victorian Climbing Club
 */

get_header(); ?>

<div id="primary" class="content-area events">
  <main id="main" class="site-main" role="main">
    <?php if (have_posts()) : ?>
      <header class="events__upcoming-header">
        <h1 id="upcoming">Upcoming Events</h1>
        <nav class="events__upcoming-header__past">
          Subscribe via <a class="rsswidget" href="http://feeds.feedburner.com/vcc/events" target="_blank">RSS</a> <a class="rsswidget" href="http://feeds.feedburner.com/vcc/events" target="_blank"><img class="rss-widget-icon" style="border:0" width="14" height="14" src="https://vicclimb.org.au/wp-includes/images/rss.png" alt="RSS" /></a><br/>
          See <a href="#previous">Past Events</a>
        </nav>
      </header>

      <?php
        $events_upcoming = vcc_events_upcoming_query(array('posts_per_archive_page' => -1));
        $events_tba = vcc_events_tba_query(array('posts_per_archive_page' => -1));

        while ($events_upcoming->have_posts()) {
          $events_upcoming->the_post();
          get_template_part('event', 'summary');
        }

        while ($events_tba->have_posts()) {
          $events_tba->the_post();
          get_template_part('event', 'summary');
        }
      ?>

      <?php if (!$events_upcoming->found_posts && !$events_tba->found_posts): ?>
        <p>There’s no scheduled upcoming events</p>
      <?php endif; ?>

      <h1 id="previous">Past Events</h1>

      <?php
        $events_past = vcc_events_past_query(array('posts_per_archive_page' => -1));

        while ($events_past->have_posts()) {
          $events_past->the_post();
          get_template_part('event', 'summary');
        }
      ?>
    <?php else : ?>
      <?php get_template_part('content', 'none'); ?>
    <?php endif; ?>
  </main>
</div>

<?php get_footer(); ?>
