<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Yosemite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		<div class="entry-meta">
			<?php
				yosemite_show_category_list();
			?>
		</div><!-- .entry-meta -->
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="entry-meta">
			<?php
				yosemite_show_author();
				yosemite_posted_on();
				yosemite_show_comment();
			?>

		</div>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'yosemite-lite' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<div class="entry-footer">
		<?php yosemite_show_tag_list(); ?>
	</div><!-- entry-footer -->

	<?php if ( get_the_author_meta( 'description' ) ) : ?>
		<?php if ( function_exists( 'jetpack_author_bio' ) ) { jetpack_author_bio();} ?>
	<?php endif; ?>
</article><!-- #post-## -->
