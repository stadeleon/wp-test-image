<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Yosemite
 */

?>

	</div><!-- #content -->
	<aside id="secondary" class="sidebar-footer widget-area" role="complementary">
		<div class="container">
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</div>
	</aside><!-- .sidebar-footer  -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<?php
			if ( function_exists( 'jetpack_social_menu' ) ) {
				jetpack_social_menu();
			}
			?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<div class="site-info">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'yosemite-lite' ) ); ?>">
					<?php
						/* translators: %s is replaced with 'string' */
						printf( esc_html__( 'Proudly powered by %s', 'yosemite-lite' ), 'WordPress' );
					?>
				</a>
				<span> | </span>
				<?php
					/* translators: %1$s is replaced with 'string', %2$s is replaced with 'string' */
					printf( esc_html__( 'Theme: %1$s by', 'yosemite-lite' ), 'Yosemite' );
				?>
				<a href="<?php echo esc_url( __( 'https://gretathemes.com/', 'yosemite-lite' ) ) ?>" rel="designer">GretaThemes</a>
			</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<nav class="mobile-navigation" role="navigation">
	<?php
	wp_nav_menu( array(
		'container_class' => 'mobile-menu',
		'menu_class'      => 'mobile-menu clearfix',
		'theme_location'  => 'menu-1',
		'items_wrap'      => '<ul>%3$s</ul>',
	) );
	?>
</nav>
<a href="#" class="scroll-to-top hidden"><i class="fa fa-angle-up"></i></a>

<?php wp_footer(); ?>

</body>
</html>
