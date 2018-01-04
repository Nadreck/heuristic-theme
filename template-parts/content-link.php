<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

		<div class="entry-meta">
			<?php heuristic_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'heuristic' ),
				'after'  => '</div>',
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
</article><!-- #post-## -->
