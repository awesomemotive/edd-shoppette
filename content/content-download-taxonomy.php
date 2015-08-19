<?php
/**
 * download taxonomy template... matches the store front template
 * all changes made here should also be made to the store front template
 * found at - templates/content-store-front.php
 */
?>

<div id="store-front">
<?php if ( have_posts() ) : $i = 1;
	if ( is_tax( 'download_category' ) || is_tax( 'download_tag' ) ) {
		$download_term = $wp_query->get_queried_object();

		if ( 'download_category' === $download_term->taxonomy ) {
			$term_type = _x( 'Category', 'download category archive page title', 'shoppette' ) . ': ';
		} elseif ( 'download_tag' === $download_term->taxonomy ) {
			$term_type = _x( 'Tag', 'download tag archive page title', 'shoppette' ) . ': ';
		}

		if ( ! empty( $term_type ) ) {
		?>
		<div class="store-info">
			<h1 class="store-title"><?php echo $term_type; ?><strong><?php echo $download_term->name; ?></strong></h1>
			<?php if ( ! empty( $download_term->description ) ) { ?>
				<div class="store-description">
					<p><?php echo $download_term->description; ?></p>
				</div>
			<?php } ?>
		</div>
		<?php
		}
	}
	?>
	<div class="product-grid clear">
		<?php while ( have_posts() ) : the_post(); ?>
			
			<div class="threecol product">
				<div class="product-image">
					<?php if ( has_post_thumbnail() ) { ?>
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'product-img', array( 'class' => 'product-img' ) ); ?>
						</a>
					<?php } ?>
				</div>
				<div class="product-description">
					<a class="product-title" href="<?php the_permalink(); ?>">
						<?php the_title( '<h3>', '</h3>' ); ?>
					</a>
					<?php if ( get_theme_mod( 'shoppette_download_description' ) != 1 ) : // show downloads description? ?>
						<div class="product-info">
							<?php the_excerpt(); ?>
						</div>
					<?php endif; ?>
					<?php if ( get_theme_mod( 'shoppette_product_view_details' ) ) : ?>
						<a class="view-details" href="<?php the_permalink(); ?>"><?php echo get_theme_mod( 'shoppette_product_view_details' ); ?></a>
					<?php endif; ?>
				</div>
			</div>

			<?php $i+=1; ?>
		<?php endwhile; ?>
	</div>			
	<div class="store-pagination">
		<?php 					
			$big = 999999999; // need an unlikely intege					
			echo paginate_links( array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var( 'paged' ) ),
				'total' => $wp_query->max_num_pages,
				'prev_text' => '<i class="fa fa-arrow-circle-left"></i> Previous',
				'next_text' => 'Next <i class="fa fa-arrow-circle-right"></i>'
			) );
		?>
	</div>
<?php else : ?>
	<div class="store-404">
		<h2 class="center"><?php _e( 'Not Found', 'shoppette' ); ?></h2>
		<p class="center"><?php _e( 'Sorry, but you are looking for something that isn\'t here.', 'shoppette' ); ?></p>
	</div>
<?php endif; ?>
</div>