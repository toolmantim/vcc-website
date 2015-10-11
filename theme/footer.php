<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Victorian Climbing Club
 */
?>

	</div><!-- #content -->

	<footer class="site-footer" role="contentinfo">
		<div class="site-footer__content__inner">
      <div class="site-footer__links">
        <nav class="site-footer__nav" role="navigation">
          <h1 class="site-footer__heading">VCC</h1>
          <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
        </nav>
        <nav class="site-footer__nav" role="navigation">
          <h1 class="site-footer__heading">Resources</h1>
          <div class="site-footer__nav__secondary">
            <?php wp_nav_menu( array( 'menu_id' => 'footer-secondary-menu' ) ); ?>
          </div>
        </nav>
        <nav class="site-footer__social-nav" role="navigation">
          <ul>
            <li><a href="http://facebook.com/"><img src="/wp-content/themes/vcc/images/facebook.svg" alt="Facebook"></a></li>
            <li><a href="http://instagram.com/"><img src="/wp-content/themes/vcc/images/instagram.svg" alt="Instagram"></a></li>
            <li><a href="http://twitter.com/"><img src="/wp-content/themes/vcc/images/twitter.svg" alt="Twitter"></a></li>
          </ul>
        </nav>
      </div>
      <hr class="site-footer__divider">
      <nav class="site-footer__bottom" role="navigation">
        <a href="mailto:hello@vicclimb.org.au">hello@vicclimb.org.au</a>
      </nav>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
