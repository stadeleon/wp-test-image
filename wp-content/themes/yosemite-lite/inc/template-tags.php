<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Yosemite
 */

/**
 * Prints HTML with meta information for the current post-date/time
 */
function yosemite_posted_on() {

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

	echo '<span class="posted-on"><i class="fa fa-clock-o"></i>' . $posted_on . '</span>'; // WPCS: XSS OK.
}

/**
 * Prints HTML with number of comments
 */
function yosemite_show_comment() {
	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link"><i class="fa fa-comments-o"></i>';

		/* translators: get the title of the post */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'yosemite-lite' ), array(
			'span' => array(
				'class' => array(),
			),
		) ), get_the_title() ) );
		echo '</span>';
	}
}

/**
 * Prints HTML with meta information for the categories
 */
function yosemite_show_category_list() {
	/* translators: used between list items, there is a space after the comma */
	$categories_list = get_the_category_list( esc_html__( ', ', 'yosemite-lite' ) );
	if ( $categories_list && yosemite_categorized_blog() ) {
		printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>', esc_html__( 'Categories', 'yosemite-lite' ), $categories_list );
		// WPCS: XSS OK.
	}
}

/**
 * Prints HTML with meta information for the tags
 */
function yosemite_show_tag_list() {
	$tags_list = get_the_tag_list( '<div class="tagcloud">', '', '</div>' );
	if ( $tags_list ) {
		echo $tags_list; // WPCS: XSS OK.
	}
}

/**
 * Prints HTML with meta information for author
 */
function yosemite_show_author() {
	$author_name = get_the_author();
	echo '<span class="by-author"><i class="fa fa-user"></i>by <a class="url fn n" href="'
	. esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" rel="bookmark">'
	. esc_html( $author_name )
	. '</a></span>';
}

/**
 * Prints HTML with meta information for the current post-date/time.
 */
function yosemite_featured_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	echo '<span class="posted-on">' . $time_string . '</span>'; // WPCS: XSS OK.
}

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function yosemite_entry_footer() {
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'yosemite-lite' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function yosemite_categorized_blog() {
	$all_the_cool_cats = get_transient( 'yosemite_categories' );
	if ( false === $all_the_cool_cats ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );
		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'yosemite_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so yosemite_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so yosemite_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in yosemite_categorized_blog.
 */
function yosemite_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'yosemite_categories' );
}
add_action( 'edit_category', 'yosemite_category_transient_flusher' );
add_action( 'save_post',     'yosemite_category_transient_flusher' );

/**
 * Change the tag could args
 *
 * @param array $args Widget parameters.
 *
 * @return mixed
 */
function yosemite_tag_cloud_args( $args ) {
	$args['largest']  = 1; // Largest tag.
	$args['smallest'] = 1; // Smallest tag.
	$args['unit']     = 'rem'; // Tag font unit.

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'yosemite_tag_cloud_args' );

/**
 * Getter function for Featured Content.
 *
 * @return array An array of WP_Post objects.
 */
function yosemite_get_featured_posts() {
	return apply_filters( 'yosemite_get_featured_posts', array() );
}


