<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Victorian Climbing Club
 */

  $header_photos = [
    [
      "path" => "/wp-content/themes/vcc/images/header-photos/2.jpg",
      "who" => "Elvis and Presley",
      "trip" => [
        "title" => "Another Trip #3, January 2015",
        "path"  => "/2015/01/another-trip"
      ],
      "photographer" => [
        "name" => "Monkey Magic",
        "url" => "https://flickr.com/photos/ed"
      ]
    ],
    [
      "path" => "/wp-content/themes/vcc/images/header-photos/1.jpg",
      "who" => "Mary, Joe and Jane ",
      "trip" => [
        "title" => "Summerday Valley Trip #3, February 2015",
        "path"  => "/2015/02/summerday-valley"
      ],
      "photographer" => [
        "name" => "Ed Dunens",
        "url" => "https://flickr.com/photos/ed"
      ]
    ],
    [
      "path" => "/wp-content/themes/vcc/images/header-photos/3.jpg",
      "who" => "Jimmy James",
      "trip" => [
        "title" => "Queens Birthday Weekend, June 2015",
        "path"  => "/2015/05/queens-birthday-weekend"
      ],
      "photographer" => [
        "name" => "Jane Cash",
        "url" => "https://flickr.com/photos/ed"
      ]
    ],
    [
      "path" => "/wp-content/themes/vcc/images/header-photos/4.jpg",
      "who" => "Jones Jimmy",
      "trip" => [
        "title" => "Easter Weekend, March 2015",
        "path"  => "/2015/03/easter-weekend"
      ],
      "photographer" => [
        "name" => "Josh Davis",
        "url" => "https://flickr.com/photos/ed"
      ]
    ]
  ]

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php if (strpos($_SERVER['SERVER_NAME'],'vicclimb') == FALSE) : ?>
  <!-- live reload in local dev only -->
  <script>document.write('<script src="http://localhost:35729/livereload.js?snipver=1"></' + 'script>')</script>
<?php endif; ?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
  <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'vcc' ); ?></a>

  <header id="masthead" class="site-header" role="banner">
    <div class="site-header__content">
      <div class="site-header__content__inner">
        <div class="site-header__branding">
          <h1 class="site-header__branding__name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Victorian Climbing Club</a></h1>
          <h2 class="site-header__branding__description">Bringing climbers together since 1952</h2>
        </div><!-- .site-branding -->

        <nav id="site-navigation" class="site-header__nav" role="navigation">
          <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
        </nav><!-- #site-navigation -->

        <div class="site-header__photos-selector">
          <?php foreach ($header_photos as $index => $photo): ?>
            <button data-photo-index="<?php echo $index ?>" title="<?php echo esc_html($photo["who"]) ?>" class="site-header__photos-selector__button" <?php if ($index == 0): ?>data-photo-selected<?php endif ?>></button>
          <?php endforeach ?>
        </div>
      </div>
    </div>

    <div class="site-header__photos">
      <?php foreach ($header_photos as $index => $photo): ?>
        <figure style="background-image: url(<?php echo $photo["path"] ?>)" class="site-header__photos__photo" <?php if ($index == 0): ?>data-photo-selected<?php else: ?>data-photo-hidden<?php endif ?>>
          <span class="site-header__photos__photo__img-container">
            <img class="site-header__photos__photo__img" src="<?php echo $photo["path"] ?>" alt="<?php echo esc_html($photo["who"]) ?>" style="display: none">
          </span>
          <figcaption class="site-header__photos__photo__caption">
            <figcaption class="site-header__photos__photo__caption__inner">
              <span class="site-header__photos__photo__cred">Photo: <a href="<?php echo esc_html($photo["photographer"]["url"]) ?>"><?php echo esc_html($photo["photographer"]["name"]) ?></a></span>
              <span class="site-header__photos__photo__title"><?php echo esc_html($photo["photographer"]["url"]) ?></span>
              <a href="<?php echo esc_html($photo["trip"]["path"]) ?>" class="header__photos__photo__trip"><?php echo esc_html($photo["trip"]["title"]) ?></a>
            </figcaption>
          </figcaption>
        </figure>
      <?php endforeach ?>
    </div>
  </header>

  <div id="content" class="site-content">
