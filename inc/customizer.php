<?php
/**
 * Theme Customizer
 */
function shoppette_customize_register( $wp_customize ) {
	
	/** ===============
	 * Extends CONTROLS class to add textarea
	 */
	class shoppette_customize_textarea_control extends WP_Customize_Control {
		public $type = 'textarea';
		public function render_content() { ?>
	
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<textarea rows="5" style="width:98%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
		</label>
	
		<?php }
	}
	

	/** ===============
	 * Site Title (Logo) & Tagline
	 */
	// section adjustments
	$wp_customize->get_section( 'title_tagline' )->title = __( 'Site Title (Logo) & Tagline', 'shoppette' );
	$wp_customize->get_section( 'title_tagline' )->priority = 10;
	
	//site title
	$wp_customize->get_control( 'blogname' )->priority = 10;
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	
	// tagline
	$wp_customize->get_control( 'blogdescription' )->priority = 30;
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	
	// logo uploader
	$wp_customize->add_setting( 'shoppette_logo', array( 'default' => null ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'shoppette_logo', array(
		'label'		=> __( 'Custom Site Logo (replaces title)', 'shoppette' ),
		'section'	=> 'title_tagline',
		'settings'	=> 'shoppette_logo',
		'priority'	=> 20
	) ) );


	/** ===============
	 * Layout Options
	 */
	$wp_customize->add_section( 'shoppette_layout_design', array(
    	'title'       	=> __( 'Layout & Design', 'shoppette' ),
		'description' 	=> __( 'Control the column configuration and color scheme of your site.', 'shoppette' ),
		'priority'   	=> 15,
	) );
	$wp_customize->add_setting( 'shoppette_layout', array( 
		'default' => 'sc', 
		'sanitize_callback' => 'shoppette_sanitize_layout' 
	) );
	$wp_customize->add_control( 'shoppette_layout', array(
		'type' => 'select',
		'label' => __( 'Choose a layout:', 'shoppette' ),
		'section' => 'shoppette_layout_design',
		'choices' => array(
			'sc'	=> 'Sidebar - Content',
			'cs'	=> 'Content - Sidebar'
	) ) );
	$wp_customize->add_setting( 'shoppette_stylesheet', array( 
		'default' => 'picnic', 
		'sanitize_callback' => 'shoppette_sanitize_design' 
	) );
	$wp_customize->add_control( 'shoppette_stylesheet', array(
		'type' => 'select',
		'label' => __( 'Choose a color scheme:', 'shoppette' ),
		'section' => 'shoppette_layout_design',
		'choices' => array(
			'picnic'		=> 'Picnic',
			'campaign'		=> 'Campaign',
			'equipment'		=> 'Equipment',
			'clay'			=> 'Clay',
			'golden'		=> 'Golden',
			'upstream'		=> 'Upstream',
			'lazer'			=> 'Lazer',
			'crafty'		=> 'Crafty',
			'steel'			=> 'Steel',
	) ) );	


	/** ===============
	 * Content Options
	 */
	$wp_customize->add_section( 'shoppette_content_section', array(
    	'title'       	=> __( 'Content Options', 'shoppette' ),
		'description' 	=> __( 'Adjust the display of content on your website. All options have a default value that can be left as-is but you are free to customize.', 'shoppette' ),
		'priority'   	=> 20,
	) );
	// show alert bar?
	$wp_customize->add_setting( 'shoppette_alert_bar', array( 
		'default' => 1,
		'sanitize_callback' => 'shoppette_sanitize_checkbox'  
	) );
	$wp_customize->add_control( 'shoppette_alert_bar', array(
		'label'		=> __( 'Show Alert Bar?', 'shoppette' ),
		'section'	=> 'shoppette_content_section',
		'priority'	=> 10,
		'type'      => 'checkbox',
	) );
	// alert bar text
	$wp_customize->add_setting( 'shoppette_alert_bar_text', array( 
		'default' => null,
		'sanitize_callback' => 'shoppette_sanitize_link_text' 
	) );
	$wp_customize->get_setting( 'shoppette_alert_bar_text' )->transport = 'postMessage';
	$wp_customize->add_control( 'shoppette_alert_bar_text', array(
		'label'		=> __( 'Alert Bar Text (anchor tags allowed)', 'shoppette' ),
		'section'	=> 'shoppette_content_section',
		'settings'	=> 'shoppette_alert_bar_text',
		'priority'	=> 11,
	) );
	// post content
	$wp_customize->add_setting( 'shoppette_post_content', array( 
		'default' => 'full_content',
		'sanitize_callback' => 'shoppette_sanitize_radio'  
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'shoppette_post_content', array(
		'label'		=> __( 'Post Feed Content', 'shoppette' ),
		'section'	=> 'shoppette_content_section',
		'settings'	=> 'shoppette_post_content',
		'priority'	=> 20,
		'type'      => 'radio',
		'choices'   => array(
			'excerpt'		=> 'Excerpt',
			'full_content'	=> 'Full Content'
		),
	) ) );
	// read more link
	$wp_customize->add_setting( 'shoppette_read_more', array(
		'default' => __( 'Read More', 'shoppette' ),
		'sanitize_callback' => 'shoppette_sanitize_text' 
	) );
	$wp_customize->get_setting( 'shoppette_read_more' )->transport = 'postMessage';
	$wp_customize->add_control( 'shoppette_read_more', array(
	    'label' 	=> __( 'Excerpt & More Link Text', 'shoppette' ),
	    'section' 	=> 'shoppette_content_section',
		'settings' 	=> 'shoppette_read_more',
		'priority'	=> 25,
	) );
	// show featured images on feed?
	$wp_customize->add_setting( 'shoppette_featured_image', array( 
		'default' => 0,
		'sanitize_callback' => 'shoppette_sanitize_checkbox'  
	) );
	$wp_customize->add_control( 'shoppette_featured_image', array(
		'label'		=> __( 'Show Featured Images in post listings?', 'shoppette' ),
		'section'	=> 'shoppette_content_section',
		'priority'	=> 30,
		'type'      => 'checkbox',
	) );
	// show featured images on posts?
	$wp_customize->add_setting( 'shoppette_single_featured_image', array( 
		'default' => 0,
		'sanitize_callback' => 'shoppette_sanitize_checkbox'  
	) );
	$wp_customize->add_control( 'shoppette_single_featured_image', array(
		'label'		=> __( 'Show Featured Images on Single Posts?', 'shoppette' ),
		'section'	=> 'shoppette_content_section',
		'priority'	=> 40,
		'type'      => 'checkbox',
	) );
	// show single post footer?
	$wp_customize->add_setting( 'shoppette_post_footer', array( 
		'default' => 1,
		'sanitize_callback' => 'shoppette_sanitize_checkbox'  
	) );
	$wp_customize->add_control( 'shoppette_post_footer', array(
		'label'		=> __( 'Show Post Footer on Single Posts?', 'shoppette' ),
		'section'	=> 'shoppette_content_section',
		'priority'	=> 50,
		'type'      => 'checkbox',
	) );
	// comments on pages?
	$wp_customize->add_setting( 'shoppette_page_comments', array( 
		'default' => 0,
		'sanitize_callback' => 'shoppette_sanitize_checkbox'  
	) );
	$wp_customize->add_control( 'shoppette_page_comments', array(
		'label'		=> __( 'Display Comments on Standard Pages?', 'shoppette' ),
		'section'	=> 'shoppette_content_section',
		'priority'	=> 60,
		'type'      => 'checkbox',
	) );
	// credits & copyright
	$wp_customize->add_setting( 'shoppette_credits_copyright', array( 
		'default' => null,
		'sanitize_callback' => 'shoppette_sanitize_link_text' 
	) );
	$wp_customize->get_setting( 'shoppette_credits_copyright' )->transport = 'postMessage';
	$wp_customize->add_control( 'shoppette_credits_copyright', array(
		'label'		=> __( 'Footer Credits & Copyright', 'shoppette' ),
		'section'	=> 'shoppette_content_section',
		'settings'	=> 'shoppette_credits_copyright',
		'priority'	=> 70,
	) );
	
	
	/** ===============
	 * Easy Digital Downloads Options
	 */
	// only if EDD is activated
	if ( class_exists( 'Easy_Digital_Downloads' ) ) {
		$wp_customize->add_section( 'shoppette_edd_options', array(
	    	'title'       	=> __( 'Easy Digital Downloads', 'shoppette' ),
			'description' 	=> __( 'All other EDD options are under Dashboard => Downloads. If you deactivate EDD, these options will no longer appear.', 'shoppette' ),
			'priority'   	=> 30,
		) );
		// show comments on downloads?
		$wp_customize->add_setting( 'shoppette_download_comments', array( 
			'default' => 0,
			'sanitize_callback' => 'shoppette_sanitize_checkbox'  
		) );
		$wp_customize->add_control( 'shoppette_download_comments', array(
			'label'		=> __( 'Comments on Downloads?', 'shoppette' ),
			'section'	=> 'shoppette_edd_options',
			'priority'	=> 10,
			'type'      => 'checkbox',
		) );
		// store front/downloads archive headline
		$wp_customize->add_setting( 'shoppette_edd_store_archives_title', array( 
			'default' => null,
			'sanitize_callback' => 'shoppette_sanitize_text' 
		) );
		$wp_customize->get_setting( 'shoppette_edd_store_archives_title' )->transport = 'postMessage';
		$wp_customize->add_control( 'shoppette_edd_store_archives_title', array(
			'label'		=> __( 'Store Front Main Title', 'shoppette' ),
			'section'	=> 'shoppette_edd_options',
			'settings'	=> 'shoppette_edd_store_archives_title',
			'priority'	=> 20,
		) );
		// store front/downloads archive description
		$wp_customize->add_setting( 'shoppette_edd_store_archives_description', array( 'default' => null ) );
		$wp_customize->add_control( new shoppette_customize_textarea_control( $wp_customize, 'shoppette_edd_store_archives_description', array(
			'label'		=> __( 'Store Front Description', 'shoppette' ),
			'section'	=> 'shoppette_edd_options',
			'settings'	=> 'shoppette_edd_store_archives_description',
			'priority'	=> 30,
		) ) );
		// hide download description (excerpt)?
		$wp_customize->add_setting( 'shoppette_download_description', array( 
			'default' => 0,
			'sanitize_callback' => 'shoppette_sanitize_checkbox'  
		) );
		$wp_customize->add_control( 'shoppette_download_description', array(
			'label'		=> __( 'Hide Download Description', 'shoppette' ),
			'section'	=> 'shoppette_edd_options',
			'priority'	=> 40,
			'type'      => 'checkbox',
		) );
		//  view details link
		$wp_customize->add_setting( 'shoppette_product_view_details', array( 
			'default' => __( 'View Full Details', 'shoppette' ),
			'sanitize_callback' => 'shoppette_sanitize_text' 
		) );
		$wp_customize->get_setting( 'shoppette_product_view_details' )->transport = 'postMessage';
		$wp_customize->add_control( 'shoppette_product_view_details', array(
		    'label' 	=> __( 'Store Item Link Text', 'shoppette' ),
		    'section' 	=> 'shoppette_edd_options',
			'settings' 	=> 'shoppette_product_view_details',
			'priority'	=> 50,
		) );
		// store front/archive item count
		$wp_customize->add_setting( 'shoppette_store_front_count', array( 
			'default' => 9,
			'sanitize_callback' => 'shoppette_sanitize_integer'
		) );		
		$wp_customize->add_control( 'shoppette_store_front_count', array(
		    'label' 	=> __( 'Store Front Item Count', 'shoppette' ),
		    'section' 	=> 'shoppette_edd_options',
			'settings' 	=> 'shoppette_store_front_count',
			'priority'	=> 60,
		) );
	}
	
	

	/** ===============
	 * Static Front Page
	 */
	// section adjustments
	$wp_customize->get_section( 'static_front_page' )->priority = 50;
}
add_action( 'customize_register', 'shoppette_customize_register' );


/** ===============
 * Sanitize checkbox options
 */
function shoppette_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return 0;
    }
}


/** ===============
 * Sanitize radio options
 */
function shoppette_sanitize_radio( $input ) {
    $valid = array(
		'excerpt'		=> 'Excerpt',
		'full_content'	=> 'Full Content'
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}


/** ===============
 * Sanitize text input
 */
function shoppette_sanitize_text( $input ) {
    return strip_tags( stripslashes( $input ) );
}


/** ===============
 * Sanitize text input to allow anchors
 */
function shoppette_sanitize_link_text( $input ) {
    return strip_tags( stripslashes( $input ), '<a>' );
}


/** ===============
 * Sanitize the layout option
 */
function shoppette_sanitize_layout( $input ) {
    $valid = array(
		'sc' => 'Sidebar - Content',
		'cs' => 'Content - Sidebar',
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return 'sc';
    }
}


/** ===============
 * Sanitize the theme design select option
 */
function shoppette_sanitize_design( $input ) {
    $valid = array(
		'picnic'		=> 'Picnic',
		'campaign'		=> 'Campaign',
		'equipment'		=> 'Equipment',
		'clay'			=> 'Clay',
		'golden'		=> 'Golden',
		'upstream'		=> 'Upstream',
		'lazer'			=> 'Lazer',
		'crafty'		=> 'Crafty',
		'steel'			=> 'Steel',
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return 'picnic';
    }
}


/** ===============
 * Sanitize integer input
 */
function shoppette_sanitize_integer( $input ) {
	return absint( $input );
}


/** ===============
 * Add Customizer UI styles to the <head> only on Customizer page
 */
function shoppette_customizer_styles() { ?>
	<style type="text/css">
		body { background: #fff; }
		#customize-controls #customize-theme-controls .description { display: block; color: #999; margin: 2px 0 15px; font-style: italic; }
		textarea, input, select, .customize-description { font-size: 12px !important; }
		.customize-control-title { font-size: 13px !important; margin: 10px 0 3px !important; }
		.customize-control label { font-size: 12px !important; }
		#customize-control-shoppette_read_more { margin-bottom: 30px; }
		#customize-control-shoppette_store_front_count input { width: 50px; }
	</style>
<?php }
add_action('customize_controls_print_styles', 'shoppette_customizer_styles');


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function shoppette_customize_preview_js() {
	wp_enqueue_script( 'shoppette_customizer', get_template_directory_uri() . '/inc/assets/js/customizer.js', array( 'customize-preview' ), SHOPPETTE_VERSION, true );
}
add_action( 'customize_preview_init', 'shoppette_customize_preview_js' );
