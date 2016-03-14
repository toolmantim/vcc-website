<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Victorian Climbing Club
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php if (strpos($_SERVER['SERVER_NAME'],'vicclimb') === FALSE) : ?>
  <!-- live reload in local dev only -->
  <script>document.write('<script src="http://localhost:35729/livereload.js?snipver=1"></' + 'script>')</script>
<?php endif; ?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
  <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'vcc' ); ?></a>

  <header id="masthead" class="site-header" role="banner">
    <div class="site-header__content__inner">
      <div class="site-header__branding">
        <h1 class="site-header__branding__name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Victorian Climbing Club</a></h1>
        <h2 class="site-header__branding__description">Bringing climbers together since 1952</h2>
      </div><!-- .site-branding -->

      <nav id="site-navigation" class="site-header__nav" role="navigation">
        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
      </nav><!-- #site-navigation -->
    </div>
  </header>

  <div id="content" class="site-content">
