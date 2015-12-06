<?php
function vcc_events_ical() {
  // - start collecting output -
  ob_start();

  // - file header -
  header('Content-type: text/calendar');
  header('Content-Disposition: attachment; filename="ical.ics"');

  // - content header -
?>
BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//<?php the_title(); ?>//NONSGML Events //EN
X-WR-CALNAME:<?php the_title(); _e(' - Events','vcc'); ?>
X-ORIGINAL-URL:<?php echo the_permalink(); ?>
X-WR-CALDESC:<?php the_title(); _e(' - Events','vcc'); ?>
CALSCALE:GREGORIAN

<?php
  $events = vcc_events_upcoming_query();

  if ($events):
    global $post;
    foreach ($events as $post):
    setup_postdata($post);

    // - custom variables -
    $custom = get_post_custom(get_the_ID());
    $sd = get_field("start_date");
    $ed = get_field("end_date");

    // - grab gmt for start -
    $gmts = date('Y-m-d H:i:s', $sd);
    $gmts = get_gmt_from_date($gmts); // this function requires Y-m-d H:i:s
    $gmts = strtotime($gmts);

    // - grab gmt for end -
    $gmte = date('Y-m-d H:i:s', $ed);
    $gmte = get_gmt_from_date($gmte); // this function requires Y-m-d H:i:s
    $gmte = strtotime($gmte);

    // - Set to UTC ICAL FORMAT -
    $stime = date('Ymd\THis\Z', $gmts);
    $etime = date('Ymd\THis\Z', $gmte);

    // - item output -
?>
BEGIN:VEVENT
DTSTART:<?php echo $stime; ?>
DTEND:<?php echo $etime; ?>
SUMMARY:<?php echo the_title(); ?>
DESCRIPTION:<?php the_excerpt_rss('', TRUE, '', 50); ?>
END:VEVENT
<?php
    endforeach;
  else :
  endif;
?>
END:VCALENDAR
<?php

  // - full output -
  $ical_output = ob_get_contents();

  ob_end_clean();

  echo $ical_output;
}

function add_vcc_events_ical_feed () {
  // add it to ?feed=events-ical
  add_feed('events-ical', 'vcc_events_ical');
}

add_action('init','add_vcc_events_ical_feed');

?>