<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Victorian Climbing Club
 */

if ( is_active_sidebar( 'homepage-cliffcare-sidebar' ) ) :
?>

<div class="home__cliffcare-sidebar" role="complementary">
	<?php dynamic_sidebar( 'homepage-sidebar' ); ?>
  <div class="home__cliffcare-sidebar__about">
    <p><a href="">About CliffCare</a></p>
  </div>
</div><!-- #secondary -->

<? endif ?>
