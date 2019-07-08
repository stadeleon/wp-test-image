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
	<?php
	if ( has_post_format( 'quote' ) ) {
		the_content(); ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
		<?php return;
	}
	?>
	<?php get_template_part( 'template-parts/content', 'media-first-post' ); ?>

	<header class="entry-header">
		<div class="entry-meta"><?php yosemite_show_category_list() ?></div>
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		$main_content = apply_filters( 'the_content', yosemite_first_post_excerpt( 55 ) );
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

	<footer class="entry-footer	">
		<div class="entry-meta">
			<?php
				yosemite_show_author();
				yosemite_posted_on();
			?>
		</div>

		<div class="read_more">
			<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_html( wp_strip_all_tags( get_the_title() ) ); ?>">
				<button class="btn btn--readmore"><?php esc_html_e( 'Continue Reading', 'yosemite-lite' ); ?></button>
			</a>
		</div>

		<div class="entry-meta">
			<?php
				yosemite_show_comment();
			?>
		</div>
	</footer>
</article><!-- #post-## -->
