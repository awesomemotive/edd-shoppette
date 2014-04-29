<?php
/**
 * search results display
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="entry-meta">
			<?php shoppette_posted_on(); ?>
		</div>
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	</header>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
</article>