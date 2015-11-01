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
            <?php wp_nav_menu( array( 'menu_id' => 'footer-menu' ) ); ?>
          </div>
        </nav>
        <nav class="site-footer__social-nav" role="navigation">
          <ul>
            <li><a href="https://www.facebook.com/vicclimb/"><img src="/wp-content/themes/vcc/images/facebook.svg" alt="Facebook"></a></li>
            <li><a href="https://instagram.com/vicclimbingclub/"><img src="/wp-content/themes/vcc/images/instagram.svg" alt="Instagram"></a></li>
          </ul>
        </nav>
      </div>
      <hr class="site-footer__divider">
      <nav class="site-footer__bottom" role="navigation">
        <div class="site-footer__bottom__left">
          <a href="mailto:contact@THISDOMAIN">contact@THISDOMAIN</a>
        </div>
        <div class="site-footer__bottom__right">
          <?php get_search_form(); ?>
        </div>
      </nav>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

<!-- Fix spam hiding mailto links -->
<script>
  (function(links) {
    for (var i = 0; i < links.length; i++) {
      links[i].href = links[i].href.replace("THISDOMAIN", window.location.host);
      links[i].innerText = links[i].innerText.replace("THISDOMAIN", window.location.host);
    }
  })(document.getElementsByTagName("a"));
</script>

</body>
</html>