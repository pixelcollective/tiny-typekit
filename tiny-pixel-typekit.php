<?php
/*
Plugin Name: &nbsp;✨Typekit WP✨
Description: Simple typekit integration for WordPress
Plugin URI: https://github.com/pixelcollective/tiny-typekit
Author: Tiny Pixel Collective, Kelly Mears <developers@tinypixel.io>
Version: 1.0.0
Author URI: https://tinypixel.io
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once plugin_dir_path( __FILE__ ). 'CMB2/init.php';

add_action( 'cmb2_admin_init', function () {
	$tinypixel_options = new_cmb2_box( array(
		'id'           => 'tiny_pixel_options',
		'title'        => esc_html__( 'Tiny Pixel', 'tiny_pixel' ),
		'object_types' => array( 'options-page' ),
		'option_key'      => 'tiny_pixel',
		'icon_url'        => 'dashicons-palmtree',
  ) );
	$typekit_options = new_cmb2_box( array (
		'id'           => 'tiny_pixel_typekit',
		'title'        => esc_html__( 'Typekit', 'cmb2' ),
		'object_types' => array( 'options-page' ),
		'option_key'   => 'tiny_pixel_typekit',
		'parent_slug'  => 'tiny_pixel',
  ) );
	$typekit_options->add_field( array (
    'name'    => esc_html__( 'Typekit', 'tiny_pixel' ),
    'desc'    => esc_html__( 'Provided by Adobe Typekit', 'tiny_pixel' ),
    'default' => 'xBoX720.js',
    'id'      => 'embed',
    'type'    => 'text',
  ) ); 
});

add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_script( 'pixel_typekit', '//use.typekit.net/'. cmb2_get_option( 'tiny_pixel_typekit', 'embed', false ), array(), null );
});

add_action('wp_head', function() {
  if (wp_script_is( 'pixel_typekit', 'enqueued' )) :
    echo '<script type="text/javascript">try{Typekit.load();}catch(e){}</script>';
  endif;
});