<?php
/**
 * generic content display
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
			if ( has_post_thumbnail() && get_theme_mod( 'shoppette_featured_image' ) != 0 ) : ?>
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'featured-img', array( 'class' => 'featured-img' ) ); ?></a>
			<?php
			endif;
		?>
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	</header>

	<?php // show excerpts on search results and main content if options is selected ?>
	<?php if ( is_search() || get_theme_mod( 'shoppette_post_content' ) == 'excerpt' ) : ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>
	<?php else : ?>
		<div class="entry-content">			
			<?php 
				the_content( __( get_theme_mod( 'shoppette_read_more' ) . '<i class="fa fa-arrow-circle-o-right"></i>', 'shoppette' ) );
	
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'shoppette' ),
					'after'  => '</div>',
				) );
			?>
		</div>
	<?php endif; ?>
</article>
