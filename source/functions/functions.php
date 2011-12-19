<?php

add_action( 'wp_enqueue_scripts', 'pocode_theme_enqueue_scripts' );

if ( ! function_exists( 'pocode_theme_enqueue_scripts' ) ) :

/**
* Add theme styles and scripts here
*/
function pocode_theme_enqueue_scripts() {

	if ( ! is_admin() ) {
		wp_enqueue_style(
			'pocode_theme-style',
			get_bloginfo( 'stylesheet_url' )
		);
	}

}

endif; // pocode_theme_enqueue_scripts

add_action( 'after_setup_theme', 'pocode_theme_setup' );

if ( ! function_exists( 'pocode_theme_setup' ) ) :

/**
* Set up your theme here
*/
function pocode_theme_setup() {
	add_theme_support( 'post-thumbnails' );
}

endif; // pocode_theme_setup
