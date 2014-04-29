<?php
/**
 * the header element and the opening of the main content elements
 */
$title = get_bloginfo('name');
$tagline = get_bloginfo('description');
$char = get_bloginfo('charset');
$ping = get_bloginfo('pingback_url');
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php echo $char; ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php echo $ping; ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div class="header-area full">
		<div class="main">
			<header id="masthead" class="site-header inner" role="banner">
				<div class="header-elements">
					<span class="site-title">
						<?php if ( get_theme_mod( 'shoppette_logo' ) ) : ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<img src="<?php echo get_theme_mod( 'shoppette_logo' ); ?>" alt="<?php echo esc_attr( $title ); ?>">
							</a>
						<?php else : ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( $title ); ?>">
								<?php echo $title; ?>
							</a>
						<?php endif; ?>
					</span>		
					<nav id="header-navigation" class="header-menu" role="navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'header', 'fallback_cb' => 'shoppette_menu_fallback' ) ); ?>
					</nav>
				</div>
			</header>
			<div class="main-menu-container">
				<nav id="site-navigation" class="main-navigation clear" role="navigation">
					<span class="menu-toggle"><?php echo '<i class="fa fa-bars"></i> ' . __( 'Menu', 'shoppette' ); ?></span>
					<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'shoppette' ); ?></a>
		
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'fallback_cb' => 'shoppette_menu_fallback' ) ); ?>
				</nav>
			</div>
		</div>
	</div>

	<div class="main-content-area full">
		<div class="main">
			<div id="content" class="site-content inner">			
				<?php 
					// only call the alert bar template if we're on the appropriate page and the option is selected
					if ( ! is_archive( 'download' ) && ! is_page_template( 'edd_templates/edd-checkout.php' ) && ! is_page_template( 'edd_templates/edd-store-front.php' ) && get_theme_mod( 'shoppette_alert_bar' ) == 1 ) :
						get_template_part( 'content/content', 'alert-bar' );
					endif;	
				?>