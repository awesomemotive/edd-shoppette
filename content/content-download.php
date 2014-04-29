<?php
/**
 * The default template for download page content
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			// display featured image?
			if ( has_post_thumbnail() ) :
				the_post_thumbnail( 'full', array( 'class' => 'featured-img' ) );
			endif; 
		?>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>
	<div class="entry-content">
		<?php
			the_content(); 
		?>
	</div>
</article>
