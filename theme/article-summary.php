<?php
/**
 * @package Victorian Climbing Club
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <a class="article-summary" href="<?php echo esc_url(get_permalink()) ?>">
    <header>
      <h1 class="article-summary__title"><?php the_title(); ?></h1>
    </header>

    <div class="article-summary__excerpt">
      <?php the_excerpt(); ?>
    </div>
  </a>
</article>
