<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

abstract class TR_Widget_Base extends \Elementor\Widget_Base {

    public function get_style_depends() {
        return [ 'tr-addons-style' ];
    }

    public function get_script_depends() {
        return [ 'tr-addons-script' ];
    }
}
