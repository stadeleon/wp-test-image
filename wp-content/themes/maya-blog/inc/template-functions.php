<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package maya_blog
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function maya_blog_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add class for global layout.
	$global_layout = maya_blog_get_option( 'global_layout' );
	$global_layout = apply_filters( 'maya_blog_filter_global_layout', $global_layout );
	$classes[] = esc_attr( $global_layout );

	return $classes;
}
add_filter( 'body_class', 'maya_blog_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function maya_blog_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'maya_blog_pingback_header' );

//=============================================================
// Function to change default excerpt
//=============================================================
if ( ! function_exists( 'maya_blog_implement_excerpt_length' ) ) :

	/**
	 * Implement excerpt length.
	 *
	 * @since 1.0.0
	 *
	 * @param int $length The number of words.
	 * @return int Excerpt length.
	 */
	function maya_blog_implement_excerpt_length( $length ) {

		if ( is_admin() ) {
			return $length;
		}

		$excerpt_length = maya_blog_get_option( 'excerpt_length' );

		if ( absint( $excerpt_length ) > 0 ) {
			$length = absint( $excerpt_length );
		}
		return $length;

	}
endif;

if ( ! function_exists( 'maya_blog_content_more_link' ) ) :

	/**
	 * Implement read more in content.
	 *
	 * @since 1.0.0
	 *
	 * @param string $more_link Read More link element.
	 * @param string $more_link_text Read More text.
	 * @return string Link.
	 */
	function maya_blog_content_more_link( $more_link, $more_link_text ) {

		if ( is_admin() ) {
			return $more_link;
		}

		$read_more_text = maya_blog_get_option('readmore_text');

		if ( ! empty( $read_more_text ) ) {

			$more_link = str_replace( $more_link_text, esc_html( $read_more_text ), $more_link );

		}

		return $more_link;

	}

endif;

if ( ! function_exists( 'maya_blog_implement_read_more' ) ) :

	/**
	 * Implement read more in excerpt.
	 *
	 * @since 1.0.0
	 *
	 * @param string $more The string shown within the more link.
	 * @return string The excerpt.
	 */
	function maya_blog_implement_read_more( $more ) {

		if ( is_admin() ) {
			return $more;
		}

		$output = $more;

		$read_more_text = maya_blog_get_option('readmore_text');

		if ( ! empty( $read_more_text ) ) {

			$output = '&hellip;<p><a href="' . esc_url( get_permalink() ) . '" class="btn">' . esc_html( $read_more_text ) . '</a></p>';

		}

		return $output;

	}
endif;

if ( ! function_exists( 'maya_blog_hook_read_more_filters' ) ) :

	/**
	 * Hook read more and excerpt length filters.
	 *
	 * @since 1.0.0
	 */
	function maya_blog_hook_read_more_filters() {
		
		add_filter( 'excerpt_length', 'maya_blog_implement_excerpt_length', 999 );
		add_filter( 'the_content_more_link', 'maya_blog_content_more_link', 10, 2 );
		add_filter( 'excerpt_more', 'maya_blog_implement_read_more' );

	}
endif;
add_action( 'wp', 'maya_blog_hook_read_more_filters' );

if ( ! function_exists( 'maya_blog_get_option' ) ) :

    /**
     * Get theme option.
     *
     * @since 1.0.0
     *
     * @param string $key Option key.
     * @return mixed Option value.
     */
    function maya_blog_get_option( $key ) {

        if ( empty( $key ) ) {

            return;

        }

        //default theme options
        $defaults = array();
        $defaults['site_identity'] 		= 'title-text';
        $defaults['global_layout'] 		= 'right-sidebar';
        $defaults['excerpt_length'] 	= 40;
        $defaults['readmore_text'] 		= esc_html__( 'Read More', 'maya-blog' );
        $defaults['copyright_text'] 	= esc_html__( 'Copyright © All rights reserved.', 'maya-blog' );

        //get theme options and use default if theme option not set
        $theme_options = get_theme_mod( 'theme_options', $defaults );
        $theme_options = array_merge( $defaults, $theme_options );
        $value = '';

        if ( isset( $theme_options[ $key ] ) ) {
            $value = $theme_options[ $key ];
        }

        return $value;

    }

endif;


/**
 * Set up the WordPress core custom header feature.
 *
 * @uses maya_blog_pro_header_style()
 */
function maya_blog_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'maya_blog_pro_custom_header_args', array(
		'default-text-color'     => '#000',
		'width'                  => 1200,
		'height'                 => 528,
		'flex-height'            => true,
		'wp-head-callback'		 => 'maya_blog_header_style',
	) ) );

}
add_action( 'after_setup_theme', 'maya_blog_custom_header_setup' );

if ( ! function_exists( 'maya_blog_header_style' ) ) :
    /**
     * Styles the header image and text displayed on the blog.
     *
     * @see maya_blog_custom_header_setup().
     */
    function maya_blog_header_style() {
        $header_text_color = get_header_textcolor();

        /*
         * If no custom options for text are set, let's bail.
         * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
         */
        if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
            return;
        }

        // If we get this far, we have custom styles. Let's do this.
        ?>
        <style type="text/css">
        <?php
        // Has the text been hidden?
        if ( ! display_header_text() ) :
        ?>
            .site-title,
            .site-description {
                position: absolute;
                clip: rect(1px, 1px, 1px, 1px);
            }
        <?php
            // If the user has set a custom color for the text use that.
            else :
        ?>
            .site-title a,
            .site-description {
                color: #<?php echo esc_attr( $header_text_color ); ?>;
            }
        <?php endif; ?>
        </style>
        <?php
    }
endif;

/**
 * Display custom header title in frontpage and blog
 */
function maya_blog_custom_header_banner_title() {
	if ( (! is_front_page() && is_home()) || is_singular() ): ?>
		<h2 class="page-title"><?php single_post_title(); ?></h2>
	<?php elseif ( is_archive() ) : 
		the_archive_title( '<h2 class="page-title">', '</h2>' );
		the_archive_description( '<div class="archive-description">', '</div>' );
	elseif ( is_search() ) : ?>
		<h2 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'maya-blog' ), get_search_query() ); ?></h2>
	<?php elseif ( is_404() ) :
		echo '<h2 class="page-title">' . esc_html__( 'Oops! That page can&#39;t be found.', 'maya-blog' ) . '</h2>';
	endif;
}