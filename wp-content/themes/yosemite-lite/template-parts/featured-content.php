<?php
/**
 * Display featured content on the homepage.
 *
 * @package Yosemite
 */

$featured_posts = yosemite_get_featured_posts();
if ( empty( $featured_posts ) ) {
	return;
}
?>
<div class="clearfix featured-posts container">
	<div class="featured-post__content">
		<?php foreach ( $featured_posts as $index => $post ) : setup_postdata( $post ); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<a href="<?php the_permalink(); ?>">

					<?php
					$url_image = get_the_post_thumbnail_url( $post, 'yosemite-featured' );
					echo '<img src="' . esc_url( $url_image ) . '" data-lazy="' . esc_url( $url_image ) . '" alt="' . get_the_title( ) . '"/>';
					?>
					<div class="featured-content">
						<div class="featured-posts-text">
							<div class="entry-meta">
								<span class="cat-links">
									<?php
										$categories = get_the_category();
										$category_keys = array_keys( $categories );
										$last_key = end( $category_keys );
									foreach ( $categories as $key => $category ) {
										if ( $key === $last_key ) {
											echo esc_html( $category->cat_name . '' );
										} else {
											echo esc_html( $category->cat_name . ', ' );
										}
									}
									?>
								</span>
								<?php yosemite_featured_posted_on() ?>
							</div>
							<?php the_title( '<h2 class="entry-title">', '</h2>' ) ?>
							<div class="read_more">
								<button class="btn btn--readmore"><?php echo esc_html__( 'Continue Reading', 'yosemite-lite' ) ?></button>
							</div>
						</div>

					</div>
				</a>
			</article>
		<?php endforeach; ?>
	</div>
</div>
<?php
wp_reset_postdata();
