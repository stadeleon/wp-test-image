<?php
 /*
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Maya Blog
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-meta">
		<?php maya_blog_posted_on();
		maya_blog_entry_meta(); ?>
	</div><!-- .entry-meta -->	

	<div class="featured-image">
		<?php the_post_thumbnail( 'full', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
	</div>
	
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'maya-blog' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	
	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php maya_blog_footer_meta(); ?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>	
</article><!-- #post-## -->