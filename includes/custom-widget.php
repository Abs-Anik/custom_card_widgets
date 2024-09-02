<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Cea_Custom_Widget extends \Elementor\Widget_Base {    

    public function get_name() {
        return 'custom_widget';
    }

    public function get_title() {
        return __( 'Custom Widget', 'custom-elementor-addon' );
    }

    public function get_icon() {
        return 'eicon-posts-ticker';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'custom-elementor-addon' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __( 'Image', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $this->add_control(
            'image_position',
            [
                'label' => __( 'Image Position', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'top' => [
                        'title' => __( 'Top', 'custom-elementor-addon' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'custom-elementor-addon' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => __( 'Bottom', 'custom-elementor-addon' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'top',
                'selectors' => [
                    '{{WRAPPER}} .custom-card .card-image' => 'vertical-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Card Title', 'custom-elementor-addon' ),
                'placeholder' => __( 'Type your title here', 'custom-elementor-addon' ),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Card description goes here.', 'custom-elementor-addon' ),
                'placeholder' => __( 'Type your description here', 'custom-elementor-addon' ),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Click Here', 'custom-elementor-addon' ),
                'placeholder' => __( 'Type your button text here', 'custom-elementor-addon' ),
            ]
        );

        $this->add_control(
            'button_url',
            [
                'label' => __( 'Button URL', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Style', 'custom-elementor-addon' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label' => __( 'Image Border Radius', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '0' => __( '0%', 'custom-elementor-addon' ),
                    '50%' => __( '50% (Circle)', 'custom-elementor-addon' ),
                    '100%' => __( '100% (Ellipse)', 'custom-elementor-addon' ),
                ],
                'default' => '0',
                'selectors' => [
                    '{{WRAPPER}} .custom-card .card-image img' => 'border-radius: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'image_width',
            [
                'label' => __( 'Image Width', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1200,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .custom-card .card-image img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_height',
            [
                'label' => __( 'Image Height', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1200,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .custom-card .card-image img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_hover_effect',
            [
                'label' => __( 'Image Hover Effect', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'none' => [
                        'title' => __( 'None', 'custom-elementor-addon' ),
                        'icon' => 'eicon-none',
                    ],
                    'zoom' => [
                        'title' => __( 'Zoom', 'custom-elementor-addon' ),
                        'icon' => 'eicon-image-zoom',
                    ],
                    'blur' => [
                        'title' => __( 'Blur', 'custom-elementor-addon' ),
                        'icon' => 'eicon-image-blur',
                    ],
                ],
                'default' => 'none',
                'selectors' => [
                    '{{WRAPPER}} .custom-card .card-image img:hover' => 'transform: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_alignment',
            [
                'label' => __( 'Title Alignment', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'custom-elementor-addon' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'custom-elementor-addon' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'custom-elementor-addon' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .custom-card .card-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'description_alignment',
            [
                'label' => __( 'Description Alignment', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'custom-elementor-addon' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'custom-elementor-addon' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'custom-elementor-addon' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .custom-card .card-description' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_alignment',
            [
                'label' => __( 'Button Alignment', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'custom-elementor-addon' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'custom-elementor-addon' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'custom-elementor-addon' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .custom-card .card-button' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        // Button Background Color Control
        $this->add_control(
            'button_background_color',
            [
                'label' => __( 'Button Background Color', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#0073e6', // Default button color
                'selectors' => [
                    '{{WRAPPER}} .custom-card .card-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Button Text Color Control
        $this->add_control(
            'button_text_color',
            [
                'label' => __( 'Button Text Color', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff', // Default text color
                'selectors' => [
                    '{{WRAPPER}} .custom-card .card-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Button Hover Background Color Control
        $this->add_control(
            'button_hover_background_color',
            [
                'label' => __( 'Button Hover Background Color', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#005bb5', // Default hover color
                'selectors' => [
                    '{{WRAPPER}} .custom-card .card-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Button Hover Text Color Control
        $this->add_control(
            'button_hover_text_color',
            [
                'label' => __( 'Button Hover Text Color', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff', // Default hover text color
                'selectors' => [
                    '{{WRAPPER}} .custom-card .card-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Neon effect color
        $this->add_control(
            'neon_effect_color',
            [
                'label' => __( 'Neon Effect Color', 'custom-elementor-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#00FF00', // Default neon green color
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $neon_color = $settings['neon_effect_color'] ? $settings['neon_effect_color'] : '#00FF00';
        $button_background_color = $settings['button_background_color'] ? $settings['button_background_color'] : '#0073e6';
        $button_text_color = $settings['button_text_color'] ? $settings['button_text_color'] : '#fff';
        $button_hover_background_color = $settings['button_hover_background_color'] ? $settings['button_hover_background_color'] : '#005bb5';
        $button_hover_text_color = $settings['button_hover_text_color'] ? $settings['button_hover_text_color'] : '#fff';
        ?>
    
        <div class="custom-card" style="border: 2px solid <?php echo esc_attr( $settings['neon_effect_color'] ); ?>;">
            <div class="card-image">
                <?php if ( $settings['image']['url'] ) : ?>
                    <img src="<?php echo esc_url( $settings['image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['title'] ); ?>">
                <?php endif; ?>
            </div>
            <h2 class="card-title"><?php echo esc_html( $settings['title'] ); ?></h2>
            <p class="card-description"><?php echo esc_html( $settings['description'] ); ?></p>
            <a class="card-button" href="<?php echo esc_url( $settings['button_url']['url'] ); ?>"><?php echo esc_html( $settings['button_text'] ); ?></a>
        </div>
    
        <style>
            .custom-card:hover {
                border-color: <?php echo esc_attr( $neon_color ); ?>;
            }
    
            .custom-card .card-button {
                background-color: <?php echo esc_attr( $button_background_color );?>;
                color: <?php echo esc_attr( $button_text_color ); ?>;
            }
    
            .custom-card .card-button:hover {
                background-color: <?php echo esc_attr( $button_hover_background_color ); ?>;
                color: <?php echo esc_attr( $button_hover_text_color ); ?>;
            }
        </style>
    
        <?php
    }
}