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

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-footer__content__inner">
        <nav id="footer-site-navigation" class="site-footer__nav" role="navigation">
          <h1>VCC</h1>
          <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
        </nav>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
