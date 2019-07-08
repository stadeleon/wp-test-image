<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package maya_blog
 */

?>

	</div><!-- #content -->

	<?php

	if ( is_active_sidebar( 'footer-1' ) ||
		 is_active_sidebar( 'footer-2' ) ||
		 is_active_sidebar( 'footer-3' ) ||
		 is_active_sidebar( 'footer-4' ) ) :
	?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php
		$column_count = 0;
		for ( $i = 1; $i <= 4; $i++ ) {

			if ( is_active_sidebar( 'footer-' . $i ) ) {
				$column_count++;
			}
		} ?>

		<?php
		$column_class = 'col-' . absint( $column_count ); ?>
		<div class="footer-widgets-area page-section <?php echo esc_attr( $column_class ); ?>">
			<div class="container">
			<?php
			for ( $i = 1; $i <= 4 ; $i++ ) {

				if ( is_active_sidebar( 'footer-' . $i ) ) { ?>

					<div class="hentry">

						<?php dynamic_sidebar( 'footer-' . $i ); ?>

					</div>

					<?php
				}

			} ?>
			</div><!-- .container -->
		</div><!-- .footer-widgets-area -->
	<?php endif; ?>

		<div class="site-info">
			<div class="container">
				<?php 
				$copyright_text = maya_blog_get_option('copyright_text');

				if ( ! empty( $copyright_text ) ) : ?>
					<span class="copyright">
						<?php echo wp_kses_data( $copyright_text ); ?>
					</span><!-- .copyright -->
				<?php endif; ?>

				<span>
				    <?php printf( esc_html__( '%1$s by %2$s', 'maya-blog' ), esc_html__( 'StaDeLeon\'s Blog', 'maya-blog' ), '<a href="' . esc_url('https://127.0.0.1') . ' " rel="designer" target="_blank">' . esc_html__( 'Leo Themes', 'maya-blog' ) . '</a>' ); ?>
				</span>
			</div><!-- .container -->
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>