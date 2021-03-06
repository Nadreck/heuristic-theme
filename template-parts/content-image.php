<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Heuristic
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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

	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php if (get_post_format()) { ?>
			<span class="entry-type"><a href="<?php echo get_post_format_link(get_post_format()); ?>"><?php echo get_post_format(); ?></a></span>
		<?php } ?>
		<?php heuristic_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	<?php if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
		echo do_shortcode( '[jetpack-related-posts]' );
	} ?>
</article><!-- #post-<?php the_ID(); ?> -->
