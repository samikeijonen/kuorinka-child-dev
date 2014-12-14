<?php
/**
 * This is child themes functions.php file. All modifications should be made in this file.
 *
 * All style changes should be in child themes style.css file.
 *
 * @package    Kuorinka Child Dev
 * @author     Sami Keijonen <sami.keijonen@foxnet.fi>
 * @copyright  Copyright (c) 2014, Sami Keijonen
 * @link       https://foxland.fi/downloads/kuorinka
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Setup function. All child themes should run their setup within this function. The idea is to add/remove 
 * filters and actions after the parent theme has been set up. This function provides you that opportunity.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function kuorinka_child_dev_theme_setup() {

	/* Load child theme text domain. */
	load_child_theme_textdomain( 'kuorinka-child-dev', get_stylesheet_directory() . '/languages' );
	
	/*
	 * Add a custom background to overwrite the defaults. Remove this section if you want to use 
	 * the parent theme defaults instead.
	 *
	 * @link http://codex.wordpress.org/Custom_Backgrounds
	 */
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'f7f7f7',
			'default-image' => ''
		)
	);
	
	/*
	 * Add a custom header to overwrite the defaults. Remove this section if you want to use the 
	 * the parent theme defaults instead.
	 *
	 * @link http://codex.wordpress.org/Custom_Headers
	 */
	add_theme_support(
		'custom-header',
		array(
			'default-text-color' => '2e2e2e',
			'default-image'      => get_stylesheet_directory_uri() . '/images/headers/child.jpg'
		)
	);
	
	/*
	 * Registers default headers for the theme. If you don't want to add custom headers, remove 
	 * this section. Note: Header thumbnail sizes should be 230x78.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_default_headers
	 */
	register_default_headers( array(
		'child' => array(
			'url'           => '%2$s/images/headers/child.jpg',
			'thumbnail_url' => '%2$s/images/headers/child-thumbnail.jpg',
			'description'   => __( 'Test header', 'kuorinka-child-dev' )
		)
	) );
	
	/* Add child theme fonts to editor styles. */
	add_editor_style( kuorinka_child_dev_fonts_url() );
	
}
add_action( 'after_setup_theme', 'kuorinka_child_dev_theme_setup', 11 );

/**
 * Enqueue scripts and styles.
 *
 * @since  1.0.0
 */
function kuorinka_child_dev_scripts() {
	
	/* Dequeue parent fonts. */
	wp_dequeue_style( 'kuorinka-fonts' );
	
	/* Enqueue fonts. */
	wp_enqueue_style( 'kuorinka-child-dev-fonts', kuorinka_child_dev_fonts_url(), array(), null );
	
}
add_action( 'wp_enqueue_scripts', 'kuorinka_child_dev_scripts', 11 );

/**
 * Return the Google font stylesheet URL
 *
 * @since  1.0.0
 * @return string
 */
function kuorinka_child_dev_fonts_url() {

	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Lato, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$lato = _x( 'on', 'Lato font: on or off', 'kuorinka-child-dev' );

	/* Translators: If there are characters in your language that are not
	 * supported by Arimo, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$arimo = _x( 'on', 'Arimo font: on or off', 'kuorinka-child-dev' );

	if ( 'off' !== $lato || 'off' !== $arimo ) {
		$font_families = array();

		if ( 'off' !== $lato )
			$font_families[] = 'Lato:300,400,700,900,300italic,400italic,700italic,900italic';

		if ( 'off' !== $arimo )
			$font_families[] = 'Arimo:400,700,400italic,700italic';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}

	return $fonts_url;
}