<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Maya Blog
 */
?>
<article id="post-<?php the_ID(); ?>">
	<div class="post-wrapper">
		<?php if ( has_post_thumbnail() ) { ?>
			<figure>
			    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
			</figure>
		<?php } ?>

		<div class="entry-container">
			<header class="entry-header">
				<?php
				if ( is_single() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif; ?>

				<div class="entry-meta">
					<?php 
						maya_blog_author_only();
						maya_blog_posted_on(); 
						maya_blog_entry_meta(); 
					?>
				</div><!-- .entry-meta -->			
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div><!-- .entry-content -->
		</div><!-- .entry-container -->
	</div>
</article><!-- #post-## -->
