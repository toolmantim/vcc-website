<?php
/**
 * The template for displaying a single event.
 *
 * @package Victorian Climbing Club
 */
?>

<article id="event-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header>
    <?php $location = get_field('location') ?>
    <img class="event-summary__map" src="https://maps.googleapis.com/maps/api/staticmap?center=<?php echo $location['lat']; ?>,<?php echo $location['lng']; ?>&zoom=11&size=125x125&maptype=roadmap&markers=color:red%7C<?php echo $location['lat']; ?>,<?php echo $location['lng']; ?>" />
    <h1 class="event-summary__title"><?php the_title(); ?></h1>
    <h2 class="event-summary__location-and-date">
      <span class="event-summary__location">
        <?php $location_name = get_field('location_name'); if ($location_name) : ?>
          <?php esc_html_e($location_name) ?>
        <?php else : ?>
          Missing location
        <?php endif ; ?>
      </span>
      •
      <span class="event-summary__date">
        <?php $start_date = DateTime::createFromFormat('Ymd', get_field('start_date')); ?>
        <?php if ($start_date): ?>
          <?php echo $start_date->format('j M Y'); ?>
        <?php else : ?>
          TBA
        <?php endif; ?>
        <?php $end_date = DateTime::createFromFormat('Ymd', get_field('end_date')); ?>
        <?php if ($end_date): ?>
          —
          <?php echo $end_date->format('j M Y'); ?>
        <?php endif; ?>
        <?php esc_html_e(get_field('time')); ?>
      </span>
    </h2>
  </header>

  <div class="event-summary__content">
    <?php the_content(); ?>
  </div>

  <?php
    $contact_name = get_field('contact_name');
  ?>
  <?php if ($contact_name): ?>
    <div class="event-summary__contact">
      Contact:
      <?php
        $contact_email = get_field('contact_email');
        if ($contact_name) {
          echo '<a href="mailto:' . $contact_email . '">' . $contact_name . '</a>';
        }
      ?>
    </div>
  <?php endif; ?>

  <?php
    $photo_album_url = get_field('photo_album_url');
  ?>
  <?php if ($photo_album_url && strlen($photo_album_url) != 0): ?>
    <div class="event-summary__photos">
      <p><strong>Check out <a href="<?php echo $photo_album_url ?>">photos from the event</a></p></strong></p>
    </div>
  <?php endif; ?>

  <footer>
    <?php vcc_entry_footer(); ?>
  </footer>
</article>
