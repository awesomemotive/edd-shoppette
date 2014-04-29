<?php
/**
 * The template used for displaying single post content in single.php
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php shoppette_posted_on(); ?>
			</div>
		<?php endif; ?>
		<?php
			// display featured image 
			if ( has_post_thumbnail() && get_theme_mod( 'shoppette_single_featured_image' ) == 1 ) : ?>
				<?php the_post_thumbnail( 'featured-img', array( 'class' => 'featured-img' ) ); ?>
			<?php
			endif;
		?>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>

	<div class="entry-content">
		<?php 
			the_content(); 
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'shoppette' ),
				'after'  => '</div>',
			) );
		?>
	</div>

	<footer class="entry-meta">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'shoppette' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'shoppette' ) );

			if ( ! shoppette_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'shoppette' );
				} else {
					$meta_text = __( 'Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'shoppette' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'shoppette' );
				} else {
					$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'shoppette' );
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink()
			);
		?>
	</footer>
</article>

<?php // show post footer? theme customizer options ?>
<?php if ( get_theme_mod( 'shoppette_post_footer' ) == 1 ) : ?>
	<div class="single-post-footer clear">
		<div class="post-footer-author">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 32, '', get_the_author_meta( 'display_name' ) ); ?>
			<h5 class="author-name"><?php echo __( 'This post was written by ', 'shoppette' ) . get_the_author_meta( 'display_name' ); ?></h5>	
		</div>
		<?php if ( ! get_the_author_meta( 'description' ) == '' ) : ?>
			<div class="post-footer-author-bio">
				<p><?php echo get_the_author_meta( 'description' ); ?></p>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>