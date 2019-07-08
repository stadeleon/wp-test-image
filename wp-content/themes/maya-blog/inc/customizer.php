<?php
/**
 * Maya Blog Theme Customizer
 *
 * @package maya_blog
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function maya_blog_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'refresh'; 

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        		=> '.site-title a',
			'container_inclusive' 	=> false,
			'render_callback' 	    => 'maya_blog_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        		=> '.site-description',
			'container_inclusive' 	=> false,
			'render_callback' 		=> 'maya_blog_customize_partial_blogdescription',
		) );
	}

	// Sanitization.
	require_once trailingslashit( get_template_directory() ) . '/inc/sanitize.php';

	// Load Upgrade to Pro control.
	require_once trailingslashit( get_template_directory() ) . '/inc/upgrade-to-pro/control.php';

	// Register custom section types.
	$wp_customize->register_section_type( 'maya_blog_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new maya_blog_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Maya Blog Pro', 'maya-blog' ),
				'pro_text' => esc_html__( 'BUY PRO', 'maya-blog' ),
				'pro_url'  => 'http://www.karunathemes.com/downloads/maya-blog-pro/',
				'priority' => 1,
			)
		)
	);
	
	// Add Theme Options Panel.
	$wp_customize->add_panel( 'theme_option_panel',
		array(
			'title'      => esc_html__( 'Theme Options', 'maya-blog' ),
			'priority'   => 100,
		)
	);

	// Header Section.
	$wp_customize->add_section( 'section_header',
		array(
			'title'      => esc_html__( 'Header', 'maya-blog' ),
			'priority'   => 100,
			'panel'      => 'theme_option_panel',
		)
	);

	// Layout Section.
	$wp_customize->add_section( 'section_layout',
		array(
			'title'      => esc_html__( 'Layouts', 'maya-blog' ),
			'priority'   => 100,
			'panel'      => 'theme_option_panel',
		)
	);

	// Setting global_layout.
	$wp_customize->add_setting( 'theme_options[global_layout]',
		array(
			'default'           => 'right-sidebar',
			'sanitize_callback' => 'maya_blog_sanitize_select',
		)
	);
	$wp_customize->add_control( 'theme_options[global_layout]',
		array(
			'label'    => esc_html__( 'Default Sidebar Layout', 'maya-blog' ),
			'section'  => 'section_layout',
			'type'     => 'radio',
			'priority' => 100,
			'choices'  => array(
					'left-sidebar'  => esc_html__( 'Left Sidebar', 'maya-blog' ),
					'right-sidebar' => esc_html__( 'Right Sidebar', 'maya-blog' ),
					'no-sidebar' 	=> esc_html__( 'No Sidebar', 'maya-blog' ),
				),
		)
	);

	// Setting excerpt_length.
	$wp_customize->add_setting( 'theme_options[excerpt_length]',
		array(
			'default'           => 40,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control( 'theme_options[excerpt_length]',
		array(
			'label'       => esc_html__( 'Excerpt Length', 'maya-blog' ),
			'section'     => 'section_layout',
			'type'        => 'number',
			'priority'    => 100,
			'input_attrs' => array( 'min' => 1, 'max' => 500, 'style' => 'width: 55px;' ),
		)
	);

	// Setting readmore_text.
	$wp_customize->add_setting( 'theme_options[readmore_text]',
		array(
			'default'           => esc_html__( 'Read More', 'maya-blog' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control( 'theme_options[readmore_text]',
		array(
			'label'    => esc_html__( 'Read More Text', 'maya-blog' ),
			'section'  => 'section_layout',
			'type'     => 'text',
			'priority' => 100,
		)
	);

	// Footer Section.
	$wp_customize->add_section( 'section_footer',
		array(
			'title'      => esc_html__( 'Footer', 'maya-blog' ),
			'priority'   => 100,
			'panel'      => 'theme_option_panel',
		)
	);

	// Setting copyright_text.
	$wp_customize->add_setting( 'theme_options[copyright_text]',
		array(
			'default'           => esc_html__( 'Copyright © All rights reserved.', 'maya-blog' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control( 'theme_options[copyright_text]',
		array(
			'label'    => esc_html__( 'Copyright Text', 'maya-blog' ),
			'section'  => 'section_footer',
			'type'     => 'text',
			'priority' => 100,
		)
	);

}

add_action( 'customize_register', 'maya_blog_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function maya_blog_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function maya_blog_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Enqueue style for custom customize control.
 */
function maya_blog_custom_customizer_scripts() {

	wp_enqueue_script( 'maya-blog-customize-controls', get_template_directory_uri() . '/inc/upgrade-to-pro/customize-controls.js', array( 'customize-controls' ) );

	wp_enqueue_style( 'maya-blog-customize-controls', get_template_directory_uri() . '/inc/upgrade-to-pro/customize-controls.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'maya_blog_custom_customizer_scripts' );