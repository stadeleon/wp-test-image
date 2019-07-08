<?php
/**
 * Display an optional post thumbnail, video, gallery in according to post formats
 * above the post excerpt in the archive page.
 *
 * @package Yosemite
 */

if ( has_post_format( array( 'video', 'audio' ) ) ) {
	$main_content = apply_filters( 'the_content', get_the_content() );
	$media        = get_media_embedded_in_content( $main_content, array(
		'video',
		'audio',
		'object',
		'embed',
		'iframe',
	) );

	if ( $media ) {
		echo '<div class="entry-media">' . reset( $media ) . '</div>'; /* WPCS: xss ok. */

		return;
	}
}

if ( get_post_gallery() ) :
	$gallery = get_post_gallery( get_the_id(), false );
	$gallery_id = explode( ',', $gallery['ids'] );
	?>
	<div class="grid-gallery">
		<?php
		foreach ( $gallery_id as $id ) :
		?>
			<?php echo wp_get_attachment_image( $id, 'yosemite-first-post' );  ?>
		<?php
		endforeach;
		?>
	</div>
	<?php
	return;
endif;

if ( ! has_post_thumbnail() ) {
	return;
}
?>

<div class="entry-media">
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		<?php the_post_thumbnail( 'yosemite-first-post' ); ?>
	</a>
	<?php if ( is_sticky() ) : ?>
		<span class="sticky-label"><i class="fa fa-star"></i><span class="screen-reader-text"><?php esc_html_e( 'Featured', 'yosemite-lite' ); ?></span></span>
	<?php endif; ?>
</div>
