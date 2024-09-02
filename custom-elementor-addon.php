<?php
/**
 * Plugin Name: TR ADDONS
 * Description: A custom Elementor addon widget with neon border effects and responsive design.
 * Version: 1.0.0
 * Author: Anik
 * Text Domain: custom-elementor-addon
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function cea_enqueue_scripts() {
    wp_enqueue_style( 'custom-widget-css', plugin_dir_url( __FILE__ ) . 'assets/css/custom-widget.css' );
    wp_enqueue_script( 'custom-widget-js', plugin_dir_url( __FILE__ ) . 'assets/js/custom-widget.js', array('jquery'), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'cea_enqueue_scripts' );

function cea_register_widgets() {
    require_once( __DIR__ . '/includes/custom-widget.php' );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Cea_Custom_Widget() );
}
add_action( 'elementor/widgets/widgets_registered', 'cea_register_widgets' );
