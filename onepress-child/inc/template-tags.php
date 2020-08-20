<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package OnePress
 */

/**
 * Display header brand
 *
 * @since 1.2.1
 */

add_filter( 'get_custom_logo', 'onepress_add_retina_logo', 15 );
if ( ! function_exists( 'onepress_site_logo_child' ) ) {
	function onepress_site_logo_child() {
		$classes = array();
		$html = '';
		$classes['logo'] = 'no-logo-img';

		if ( function_exists( 'has_custom_logo' ) ) {
			if ( has_custom_logo() ) {
				$classes['logo'] = 'has-logo-img';
				$html .= '<div class="site-logo-div">';
				$html .= get_custom_logo();
				$html .= '</div>';
			}
		}

		$hide_sitetile = get_theme_mod( 'onepress_hide_sitetitle', 0 );
		$hide_tagline  = get_theme_mod( 'onepress_hide_tagline', 0 );

		if ( ! $hide_sitetile ) {
			$classes['title'] = 'has-title';
			if ( is_front_page() && ! is_home() ) {
				$html .= '<h1 class="site-title"><a class="site-text-logo" href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . get_bloginfo( 'name' ) . '</a></h1>';
			} else {
				$html .= '<p class="site-title"><a class="site-text-logo" href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . get_bloginfo( 'name' ) . '</a></p>';
			}
		}

		if ( ! $hide_tagline ) {
			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) {
				$classes['desc'] = 'has-desc';
				$html .= '<p class="text-center site-description">' . $description . '</p>';
			}
		} else {
			$classes['desc'] = 'no-desc';
		}

		echo '<div class="site-brand-inner ' . esc_attr( join( ' ', $classes ) ) . '">' . $html . '</div>';
	}
}

add_action( 'onepress_site_start', 'onepress_site_header_child' );
if ( ! function_exists( 'onepress_site_header_child' ) ) {
	/**
	 * Display site header
	 */
	function onepress_site_header_child() {
		$header_width = get_theme_mod( 'onepress_header_width', 'contained' );
		$is_disable_sticky = sanitize_text_field( get_theme_mod( 'onepress_sticky_header_disable' ) );
		$classes = array(
			'site-header',
			'header-' . $header_width,
		);

		if ( $is_disable_sticky != 1 ) {
			$classes[] = 'is-sticky no-scroll';
		} else {
			$classes[] = 'no-sticky no-scroll';
		}

		$transparent = 'no-t';
		if ( onepress_is_transparent_header() ) {
			$transparent = 'is-t';
		}
		$classes[] = $transparent;

		$pos = sanitize_text_field( get_theme_mod( 'onepress_header_position', 'top' ) );
		if ( $pos == 'below_hero' ) {
			$classes[] = 'h-below-hero';
		} else {
			$classes[] = 'h-on-top';
		}

		?>
		<header id="masthead" class="<?php echo esc_attr( join( ' ', $classes ) ); ?>" role="banner">
			<div class="container">
				<div class="site-branding">
				<?php
				onepress_site_logo_child();
				?>
				</div>
				<div class="header-right-wrapper">
					<a href="#0" id="nav-toggle"><?php _e( 'Menu', 'onepress' ); ?><span></span></a>
					<nav id="site-navigation" class="main-navigation" role="navigation">
						<ul class="onepress-menu">
							<?php wp_nav_menu(
								array(
									'theme_location' => 'primary',
									'container' => '',
									'items_wrap' => '%3$s',
								)
							); ?>
						</ul>
					</nav>
					<!-- #site-navigation -->
				</div>
			</div>
		</header><!-- #masthead -->
		<?php
	}
}
