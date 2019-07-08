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
	<?php if ( has_post_thumbnail() || has_post_format( array( 'video', 'audio' ) ) || get_post_gallery() ) : ?>
	<div class="left-column">
		<?php get_template_part( 'template-parts/content', 'media' ); ?>
	</div>
	<?php endif; ?>

	<div class="right-column">
		<header class="entry-header">
			<div class="entry-meta"><?php yosemite_show_category_list(); ?></div>
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
			$main_content = apply_filters( 'the_content', get_the_excerpt() );

			if ( in_array( get_post_format(), array( 'audio', 'video' ), true ) ) {
				$media = get_media_embedded_in_content( $main_content, array(
					'audio',
					'video',
					'object',
					'embed',
					'iframe',
				) );
				$main_content = str_replace( $media, '', $main_content );
			}

			echo $main_content; /* WPCS: xss ok. */

			wp_link_pages( array(
				'before'      => '<div class="page-links">' . __( 'Pages:', 'yosemite-lite' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			) );
			?>
		</div><!-- .entry-content -->

		<?php if ( 'page' !== get_post_type() ) : ?>
			<div class="entry-meta">
				<?php
					yosemite_posted_on();
				?>
			</div>
		<?php endif; ?>
	</div>
</article><!-- #post-## -->
