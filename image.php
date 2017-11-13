<?php
/**
 * The template for displaying single images
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Heuristic
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post();
		?>
		
		
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php echo wp_get_attachment_image( get_the_ID(), full ); ?>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php heuristic_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'heuristic' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );
		?>
		<span style="font-size: smaller"> <?php image_meta(); ?> </span>

	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php heuristic_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->

			<?php 
			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
