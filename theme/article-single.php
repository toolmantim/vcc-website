<?php
/**
 * @package Victorian Climbing Club
 */
?>

<article id="article-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="article-header">
		<?php the_title( '<h1 class="article-title">', '</h1>' ); ?>

		<div class="article-meta">
			<?php vcc_posted_on(); ?>
		</div>
	</header>

	<div class="article-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'vcc' ),
				'after'  => '</div>',
			) );
		?>
	</div>

	<footer class="article-footer">
		<?php vcc_entry_footer(); ?>
	</footer>
</article>
