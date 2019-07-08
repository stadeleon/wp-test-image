<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Yosemite
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function yosemite_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar if don't have sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'yosemite_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function yosemite_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'yosemite_pingback_header' );

/**
 * Auto add more links.
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function yosemite_content_more() {
	/* translators: get the titlte of the post */
	$text = wp_kses_post( sprintf( __( 'Continue reading &#10142; %s', 'yosemite-lite' ), '<span class="screen-reader-text">' . get_the_title() . '</span>' ) );
	$more = sprintf( '<p class="link-more"><a href="%s#more-%d" class="more-link">%s</a></p>', esc_url( get_permalink() ), get_the_ID(), $text );

	return $more;
}
add_filter( 'the_content_more_link', 'yosemite_content_more' );

/**
 * Change the archive title for category page.
 *
 * @param string $title Page title.
 *
 * @return string
 */
function yosemite_category_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	}

	return $title;
}
add_filter( 'get_the_archive_title', 'yosemite_category_title' );

/**
 * Add wrapper class for posts if has media.
 *
 * @param array $classes Post CSS classes.
 *
 * @return array
 */
function yosemite_post_class( $classes ) {
	$wrapper = has_post_thumbnail();
	if ( in_array( get_post_format(), array( 'audio', 'video' ), true ) ) {
		$content = apply_filters( 'the_content', get_the_content() );
		$media   = get_media_embedded_in_content( $content, array( get_post_format(), 'object', 'embed', 'iframe' ) );
		$wrapper = ! empty( $media );
	}

	if ( $wrapper ) {
		$classes[] = 'yosemite-has-thumbnail';
	}

	return $classes;
}
add_filter( 'post_class','yosemite_post_class' );

/**
 *
 * Change the excerpt length
 *
 * @param   number $length the length of the exceprt.
 * @return  number
 */
function yosemite_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'yosemite_excerpt_length' );

/**
 * Custom the end of excerpt.
 *
 * @param 	 string $more The global $more.
 * @return   string
 */
function yosemite_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'yosemite_excerpt_more' );

/**
 * Change the excerpt more
 *
 * @param number $limit First Post excerpt length.
 * @return string
 */
function yosemite_first_post_excerpt( $limit ) {
	return wp_trim_words( get_the_content(), $limit );
}
