<?php
/**
 * menu fallback
 */
function shoppette_menu_fallback() { ?>
	<div class="menu-edd-pages-container">
		<ul id="menu-edd-pages" class="menu nav-menu">
			<li id="menu-item-3679" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3679">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>"><?php _e( 'Home', 'shoppette' ); ?></a>
			</li>
		</ul>
	</div>
<?php }


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function shoppette_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	
	if ( is_page_template( 'edd_templates/edd-store-front.php' ) ) {		
		$classes[] = 'edd-store-front-template edd-template';
	} elseif ( is_page_template( 'edd_templates/edd-checkout.php' ) ) {		
		$classes[] = 'edd-checkout-template edd-template';	
	} elseif ( is_page_template( 'edd_templates/edd-confirmation.php' ) ) {		
		$classes[] = 'edd-confirmation-template edd-template';
	} elseif ( is_page_template( 'edd_templates/edd-history.php' ) ) {		
		$classes[] = 'edd-history-template edd-template';
	} elseif ( is_page_template( 'edd_templates/edd-members.php' ) ) {		
		$classes[] = 'edd-members-template edd-template';
	} elseif ( is_page_template( 'edd_templates/edd-failed.php' ) ) {	
		$classes[] = 'edd-failed-template edd-template';				
	}
	
	if ( get_theme_mod( 'shoppette_layout' ) == 'cs' ) {	
		$classes[] = 'content-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'shoppette_body_classes' );


/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function shoppette_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'shoppette_setup_author' );
