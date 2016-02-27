<?php
/**
 * menu fallback
 */
function shoppette_menu_fallback() {
	?>
	<div class="menu-edd-pages-container">
		<ul id="menu-edd-pages" class="menu nav-menu">
			<li id="menu-item-3679" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3679">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>"><?php _e( 'Home', 'shoppette' ); ?></a>
			</li>
		</ul>
	</div>
	<?php
}


/**
 * Removes Page Templates from Add/Edit Page screen based on plugin activation
 *
 * @return array
 */
function shoppette_page_template_conditions( $page_templates ) {
	if ( ! shoppette_edd_is_activated() ) {
		unset( $page_templates['edd_templates/edd-checkout.php'] );
		unset( $page_templates['edd_templates/edd-confirmation.php'] );
		unset( $page_templates['edd_templates/edd-failed.php'] );
		unset( $page_templates['edd_templates/edd-history.php'] );
		unset( $page_templates['edd_templates/edd-members.php'] );
		unset( $page_templates['edd_templates/edd-store-front.php'] );
	}
	return $page_templates;
}
add_filter( 'theme_page_templates', 'shoppette_page_template_conditions' );


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
	} elseif ( is_page_template( 'edd_templates/focus.php' ) ) {
		$classes[] = 'focus-template edd-template';
	} elseif ( is_page_template( 'edd_templates/full-width.php' ) ) {
		$classes[] = 'full-width-template edd-template';
	} elseif ( is_page_template( 'edd_templates/landing.php' ) ) {
		$classes[] = 'landing-template edd-template';
	}

	if ( get_theme_mod( 'shoppette_layout' ) == 'cs' ) {
		$classes[] = 'content-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'shoppette_body_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function shoppette_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'shoppette_wp_title', 10, 2 );


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
