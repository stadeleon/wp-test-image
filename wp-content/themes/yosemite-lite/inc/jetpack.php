<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package Yosemite
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 */
function yosemite_jetpack_setup() {
	// Social menu.
	add_theme_support( 'jetpack-social-menu' );

	// Responsive videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Featured content.
	add_theme_support( 'featured-content', array(
		'filter'    => 'yosemite_get_featured_posts',
		'max_posts' => 10,
	) );
}
add_action( 'after_setup_theme', 'yosemite_jetpack_setup' );


/**
 * Author Bio Avatar Size.
 */
function yosemite_author_bio_avatar_size() {
	return 120; // in px.
}
add_filter( 'jetpack_author_bio_avatar_size', 'yosemite_author_bio_avatar_size' );
