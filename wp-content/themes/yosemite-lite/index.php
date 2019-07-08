<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Yosemite
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main yosemite-infinite-scroll" role="main">

			<?php
			if ( have_posts() ) :

				if ( is_home() && ! is_front_page() ) : ?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>

					<?php
				endif;

				/* Start the Loop */
				$i = 1;
				while ( have_posts() ) : the_post(); ?>

					<?php if ( 1 === $i ) : ?>
						<div class="first-post">
							<?php get_template_part( 'template-parts/content', 'first-post' ); ?>
						</div>
					<?php else : ?>
						<div class="following-post">
							<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
						</div>
					<?php endif; ?>

					<?php
					$i++;
				endwhile;

				the_posts_navigation( array(
					'prev_text' => esc_html__( 'Older Posts &raquo;', 'yosemite-lite' ),
					'next_text' => esc_html__( '&laquo; Newer Posts', 'yosemite-lite' ),
				) );

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
