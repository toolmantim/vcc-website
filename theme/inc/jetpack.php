<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Victorian Climbing Club
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function vcc_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'vcc_jetpack_setup' );
