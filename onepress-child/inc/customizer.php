<?php
/**
 * OnePress Theme Customizer.
 *
 * @package OnePress
 */

/**
 * Add upsell message for section
 *
 * @return string
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function onepress_customize_child_register( $wp_customize ) {


	// Load custom controls.
	$path = get_template_directory();
	require $path. '/inc/customizer-controls.php';

	/********* child original start *********/
	$path_child = get_stylesheet_directory();
	/********* child original end *********/


	// Remove default sections.

	// Custom WP default control & settings.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/**
	 * Hook to add other customize
	 */
	do_action( 'onepress_customize_before_register', $wp_customize );


	$pages  =  get_pages();
	$option_pages = array();
	$option_pages[0] = esc_html__( 'Select page', 'onepress' );
	foreach( $pages as $p ){
		$option_pages[ $p->ID ] = $p->post_title;
	}

	$users = get_users( array(
		'orderby'      => 'display_name',
		'order'        => 'ASC',
		'number'       => '',
	) );

	$option_users[0] = esc_html__( 'Select member', 'onepress' );
	foreach( $users as $user ){
		$option_users[ $user->ID ] = $user->display_name;
	}

	/**
	 * Load Customize Configs
	 * @since 2.1.0
	 */
	// Site Identity.
	require_once $path. '/inc/customize-configs/site-identity.php';

	//Site Options
	require_once $path. '/inc/customize-configs/options.php';
	require_once $path. '/inc/customize-configs/options-global.php';
	require_once $path. '/inc/customize-configs/options-colors.php';
	require_once $path. '/inc/customize-configs/options-header.php';
	require_once $path. '/inc/customize-configs/options-navigation.php';
	require_once $path. '/inc/customize-configs/options-sections-navigation.php';
	require_once $path. '/inc/customize-configs/options-page.php';
	require_once $path. '/inc/customize-configs/options-blog-posts.php';
	require_once $path. '/inc/customize-configs/options-single.php';
	require_once $path. '/inc/customize-configs/options-footer.php';

	/**
	 * @since 2.1.1
	 * Load sections if enabled
	 */
	$sections = Onepress_Config::get_sections();


	foreach( $sections as $key => $section ) {

		if ( Onepress_Config::is_section_active( $key ) ) {
			/********* child original start *********/
			if($key === 'hero')	{
				$file = $path_child. '/inc/customize-configs/section-'.$key.'.php';
			}else{
				$file = $path. '/inc/customize-configs/section-'.$key.'.php';
			}
			/********* child original end *********/
			//$file = $path. '/inc/customize-configs/section-'.$key.'.php';
			if ( file_exists( $file ) ) {
				require_once $file;
			}
		}

	}

	// Section Up sell
	require_once $path. '/inc/customize-configs/section-upsell.php';
	
	/**
	 * Hook to add other customize
	 */
	do_action( 'onepress_customize_after_register', $wp_customize );

	/**
	 * Move WC Panel to bottom
	 * @since 2.1.1
	 */
	if ( onepress_is_wc_active() ) {
		$wp_customize->get_panel( 'woocommerce' )->priority = 300;
	}

}
add_action( 'customize_register', 'onepress_customize_child_register' );
