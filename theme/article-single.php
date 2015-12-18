<?php
/**
 * The template for displaying a single news article.
 *
 * @package Victorian Climbing Club
 */
?>

<article id="article-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header>
    <h1 class="article-summary__title"><?php the_title(); ?></h1>
    <h2 class="article-summary__date"><?php vcc_posted_on(); ?></h2>
  </header>

	<div class="article-summary__content">
		<?php the_content(); ?>
	</div>

	<footer>
		<?php vcc_entry_footer(); ?>
	</footer>
</article>
