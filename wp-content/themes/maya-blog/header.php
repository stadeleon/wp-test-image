<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package maya_blog
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<header id="masthead" class="site-header">
		<div class="site-branding">
	        <div class="container">
	            <div class="site-logo">
	                <?php if(has_custom_logo()):?>
	                    <?php the_custom_logo();?>
	                <?php endif;?>
	            </div><!-- .site-logo -->

	            <div id="site-identity">
	                <h1 class="site-title">
	                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">  <?php bloginfo( 'name' ); ?></a>
	                </h1>

	                <?php 
	                    $description = get_bloginfo( 'description', 'display' );
	                    if ( $description || is_customize_preview() ) : ?>
	                    <p class="site-description"><?php echo esc_html($description);?></p>
	                <?php endif; ?>
	            </div><!-- #site-identity -->
	        </div><!-- .container -->
	    </div> <!-- .site-branding -->

	    <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="Primary Menu">
	        <div class="container">
	            <button type="button" class="menu-toggle">
	                <i class="fa fa-list-ul fa-2x"></i>
	            </button>

	            <?php
	            wp_nav_menu( array(
	                'theme_location' => 'primary',
	                'menu_id'        => 'primary-menu',
	                'menu_class'     => 'nav-menu',
	                'fallback_cb'    => 'maya_blog_primary_navigation_fallback',
	            ) );
	            ?>
	        </div><!-- .container -->
	    </nav><!-- #site-navigation -->
	</header><!-- #masthead -->

		<?php if ( has_header_image() ) {
				$class= 'header-image';
			} else {
				$class= 'disable-header-image'; 
				} ?>
	
		<div class="<?php echo $class; ?>">
			<?php if ( has_header_image() ) : ?>
				<img src="<?php header_image(); ?>" class="banner-image">
			<?php endif; ?>
			<?php maya_blog_custom_header_banner_title(); ?>
		</div>
	

	<div id="content" class="site-content">