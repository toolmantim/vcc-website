<?php
/**
 * @package Victorian Climbing Club
 */
?>

<article id="article-<?php the_ID(); ?>" <?php post_class(); ?> class="article-summary">
  <header>
    <h1 class="article-summary__title">
      <a class="article-summary__title__link" href="<?php echo esc_url(get_permalink()) ?>"><?php the_title(); ?></a>
    </h1>
    <h2 class="article-summary__date"><?php vcc_posted_on(); ?></h2>
  </header>

  <div class="article-summary__excerpt">
    <?php the_excerpt(); ?>
  </div>
</article>
