<?php
/**
 * @package Victorian Climbing Club
 */
?>

<article id="event-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<div class="entry-meta">
			<?php vcc_posted_on(); ?>
		</div>
	</header>

	<div class="entry-content" class="event-post">
    <img class="event-post__map" src="https://maps.googleapis.com/maps/api/staticmap?center=-36.75237,141.83632&zoom=11&size=125x125&maptype=roadmap&markers=color:red%7C-36.75237,141.83632" />
		<?php the_excerpt(); ?>
	</div>
</article>
