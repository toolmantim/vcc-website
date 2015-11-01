<?php
/**
 * The home version of the header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Victorian Climbing Club
 */

  $header_photos = [
    [
      "path" => "/wp-content/themes/vcc/images/header-photos/1.jpg",
      "who" => "Liz Casper, Marc Beerman and Michelle Tusch chilling out at Moonarie",
      // "trip" => [
      //   "title" => "Summerday Valley Trip #3, February 2015",
      // ],
      "photographer" => [
        "name" => "Hywel Rowlands"
      ]
    ],
    [
      "path" => "/wp-content/themes/vcc/images/header-photos/2.jpg",
      "who" => "Michael Dowling, David Focken and Josh Basset atop Gerontian (17) at Bundaleer, Grampians",
      // "trip" => [
      //   "title" => "Summerday Valley Trip #3, February 2015",
      // ],
      "photographer" => [
        "name" => "Hywel Rowlands"
      ]
    ],
    [
      "path" => "/wp-content/themes/vcc/images/header-photos/3.jpg",
      "who" => "Jason Nikakis belaying at the top of Peroxide Blond (20) at Mount Buffalo",
      // "trip" => [
      //   "title" => "Queens Birthday Weekend, June 2015",
      // ],
      "photographer" => [
        "name" => "Alex Gott-Cumbers",
        "url" => "https://agcdesign.exposure.co"
      ]
    ],
    [
      "path" => "/wp-content/themes/vcc/images/header-photos/4.jpg",
      "who" => "Aaron Lindsay climbing The Day After Invasion Day (18) at Dreamworld, Mount Buffalo",
      // "trip" => [
      //   "title" => "Easter Weekend, March 2015",
      // ],
      "photographer" => [
        "name" => "Alex Gott-Cumbers",
        "url" => "https://agcdesign.exposure.co"
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

  <header id="masthead" class="site-header-home" role="banner">
    <div class="site-header-home__content">
      <div class="site-header-home__content__inner">
        <div class="site-header-home__branding">
          <h1 class="site-header-home__branding__name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Victorian Climbing Club</a></h1>
          <h2 class="site-header-home__branding__description">Bringing climbers together since 1952</h2>
        </div><!-- .site-branding -->

        <nav id="site-navigation" class="site-header-home__nav" role="navigation">
          <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
        </nav><!-- #site-navigation -->

        <div class="site-header-home__photos-selector">
          <?php foreach ($header_photos as $index => $photo): ?>
            <button data-photo-index="<?php echo $index ?>" title="<?php esc_html_e($photo["who"]) ?>" class="site-header-home__photos-selector__button" <?php if ($index == 0): ?>data-photo-selected<?php endif ?>></button>
          <?php endforeach ?>
        </div>
      </div>
    </div>

    <div class="site-header-home__photos">
      <?php foreach ($header_photos as $index => $photo): ?>
        <figure style="background-image: url(<?php echo $photo["path"] ?>)" class="site-header-home__photos__photo" <?php if ($index == 0): ?>data-photo-selected<?php else: ?>data-photo-hidden<?php endif ?>>
          <span class="site-header-home__photos__photo__img-container">
            <img class="site-header-home__photos__photo__img" src="<?php echo $photo["path"] ?>" alt="<?php esc_html_e($photo["who"]) ?>" style="display: none">
          </span>
          <figcaption class="site-header-home__photos__photo__caption">
            <figcaption class="site-header-home__photos__photo__caption__inner">
              <span class="site-header-home__photos__photo__title"><?php esc_html_e($photo["who"]) ?></span>
              <?php if ($photo["trip"]) : ?>
                <span class="site-header-home__photos__photo__trip">
                  <em>Trip:</em>
                  <?php if ($photo["trip"]["path"]) : ?>
                    <a href="<?php esc_html_e($photo["trip"]["path"]) ?>"><?php esc_html_e($photo["trip"]["title"]) ?></a>
                  <?php else : ?>
                    <?php esc_html_e($photo["trip"]["title"]) ?>
                  <?php endif ?>
                </span>
              <?php endif ?>
              <span class="site-header-home__photos__photo__cred">
                <em>Photo:</em>
                <?php if ($photo["photographer"]["url"]) : ?>
                  <a href="<?php esc_html_e($photo["photographer"]["url"]) ?>"><?php esc_html_e($photo["photographer"]["name"]) ?></a>
                <?php else : ?>
                  <?php esc_html_e($photo["photographer"]["name"]) ?>
                <?php endif ?>
              </span>
            </figcaption>
          </figcaption>
        </figure>
      <?php endforeach ?>
    </div>
  </header>

  <div id="content" class="site-content">
