<?php
/**
 * TR Interactive Pricing Table Widget
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TR_Interactive_Pricing_Table_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'tr_interactive_pricing_table';
    }

    public function get_title() {
        return __('TR Interactive Pricing Table', 'tr-addons');
    }

    public function get_icon() {
        return 'eicon-price-table';
    }

    public function get_categories() {
        return ['tr-category'];
    }

    public function get_script_depends() {
        return ['custom-widget-js'];
    }

    public function get_style_depends() {
        return ['custom-widget-css'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'tr-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
    
        // Add Image Upload Control
        $this->add_control(
            'pricing_image',
            [
                'label' => __('Pricing Image', 'tr-addons'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
    
        // Add Image Width Control
        $this->add_responsive_control(
            'image_width',
            [
                'label' => __('Image Width', 'tr-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .TR-pricing-icon img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
            ]
        );
    
        // Add Image Height Control
        $this->add_responsive_control(
            'image_height',
            [
                'label' => __('Image Height', 'tr-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .TR-pricing-icon img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 100,
                ],
            ]
        );
    
        // Add Title Control
        $this->add_control(
            'pricing_title',
            [
                'label' => __('Pricing Title', 'tr-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Ruby', 'tr-addons'),
            ]
        );
    
        // Add Features Control
        $this->add_control(
            'pricing_features',
            [
                'label' => __('Features', 'tr-addons'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => "5 public projects\nprivate working space\nunlimited pages\n10 revisions",
                'rows' => 10,
            ]
        );
    
        // Add Button Text Control
        $this->add_control(
            'button_text',
            [
                'label' => __('Button Text', 'tr-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Start Now - $5', 'tr-addons'),
            ]
        );
    
        $this->end_controls_section();
    
        // Button Style Section
        $this->start_controls_section(
            'button_style_section',
            [
                'label' => __('Button Style', 'tr-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
    
        $this->add_control(
            'button_background_color',
            [
                'label' => __('Background Color', 'tr-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .TR-pricing-button' => 'background-color: {{VALUE}};',
                ],
                'default' => '#0073e6',
            ]
        );
    
        $this->add_control(
            'button_text_color',
            [
                'label' => __('Text Color', 'tr-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .TR-pricing-button' => 'color: {{VALUE}};',
                ],
                'default' => '#ffffff',
            ]
        );
    
        $this->add_control(
            'button_border_color',
            [
                'label' => __('Border Color', 'tr-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .TR-pricing-button' => 'border-color: {{VALUE}};',
                ],
                'default' => '#0073e6',
            ]
        );

        // Add Line Height Control for Features
        $this->add_control(
            'features_line_height',
            [
                'label' => __('Features Line Height', 'tr-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .TR-pricing-features li' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
            ]
        );
    
        $this->end_controls_section();
    }

    protected function render() {
        // Retrieve settings
        $settings = $this->get_settings_for_display();
    
        // Get the uploaded image URL
        $image_url = !empty($settings['pricing_image']['url']) ? $settings['pricing_image']['url'] : '';
    
        // Get the image width and height settings
        $image_width = !empty($settings['image_width']['size']) ? $settings['image_width']['size'] . $settings['image_width']['unit'] : '100%';
        $image_height = !empty($settings['image_height']['size']) ? $settings['image_height']['size'] . $settings['image_height']['unit'] : '100px';
    
        // Get button styles
        $button_background_color = !empty($settings['button_background_color']) ? $settings['button_background_color'] : '#0073e6';
        $button_text_color = !empty($settings['button_text_color']) ? $settings['button_text_color'] : '#ffffff';
        $button_border_color = !empty($settings['button_border_color']) ? $settings['button_border_color'] : '#0073e6';
    
        // Get title, features, and line height
        $pricing_title = !empty($settings['pricing_title']) ? $settings['pricing_title'] : 'Ruby';
        $pricing_features = !empty($settings['pricing_features']) ? explode("\n", $settings['pricing_features']) : [];
        $button_text = !empty($settings['button_text']) ? $settings['button_text'] : 'Start Now - $5';
        $features_line_height = !empty($settings['features_line_height']['size']) ? $settings['features_line_height']['size'] . $settings['features_line_height']['unit'] : '20px';
    
        // Render HTML for the Ruby pricing table with dynamic image
        ?>
        <div class="TR-pricing-table-wrapper">
            <div class="TR-pricing-card" data-monthly-price="5" data-yearly-price="50">
                <div class="TR-pricing-icon">
                    <?php if (!empty($image_url)): ?>
                        <img src="<?php echo esc_url($image_url); ?>" alt="Pricing Image" style="width: <?php echo esc_attr($image_width); ?>; height: <?php echo esc_attr($image_height); ?>;">
                    <?php else: ?>
                        <p><?php _e('No image selected', 'tr-addons'); ?></p>
                    <?php endif; ?>
                </div>
                <h3 class="TR-pricing-title"><?php echo esc_html($pricing_title); ?></h3>
                <ul class="TR-pricing-features" style="line-height: <?php echo esc_attr($features_line_height); ?>;">
                    <?php foreach ($pricing_features as $feature): ?>
                        <li><?php echo esc_html(trim($feature)); ?></li>
                    <?php endforeach; ?>
                </ul>
                <a href="#" class="TR-pricing-button" style="
                    background-color: <?php echo esc_attr($button_background_color); ?>;
                    color: <?php echo esc_attr($button_text_color); ?>;
                    border-color: <?php echo esc_attr($button_border_color); ?>;
                "><?php echo esc_html($button_text); ?></a>
            </div>
        </div>
        <?php
    }

    protected function _content_template() {
        ?>
        <#
        var image_url = settings.pricing_image.url ? settings.pricing_image.url : '';
        var image_width = settings.image_width.size ? settings.image_width.size + settings.image_width.unit : '100%';
        var image_height = settings.image_height.size ? settings.image_height.size + settings.image_height.unit : '100px';
    
        var button_background_color = settings.button_background_color ? settings.button_background_color : '#0073e6';
        var button_text_color = settings.button_text_color ? settings.button_text_color : '#ffffff';
        var button_border_color = settings.button_border_color ? settings.button_border_color : '#0073e6';
    
        var pricing_title = settings.pricing_title ? settings.pricing_title : 'Ruby';
        var pricing_features = settings.pricing_features ? settings.pricing_features.split('\n') : [];
        var button_text = settings.button_text ? settings.button_text : 'Start Now - $5';
        var features_line_height = settings.features_line_height.size ? settings.features_line_height.size + settings.features_line_height.unit : '20px';
        #>
        <div class="TR-pricing-table-wrapper">
            <div class="TR-pricing-card" data-monthly-price="5" data-yearly-price="50">
                <div class="TR-pricing-icon">
                    <# if (image_url) { #>
                        <img src="{{ image_url }}" alt="Pricing Image" style="width: {{ image_width }}; height: {{ image_height }};">
                    <# } else { #>
                        <p><?php _e('No image selected', 'tr-addons'); ?></p>
                    <# } #>
                </div>
                <h3 class="TR-pricing-title">{{{ pricing_title }}}</h3>
                <ul class="TR-pricing-features" style="line-height: {{ features_line_height }};">
                    <# _.each(pricing_features, function(feature) { #>
                        <li>{{{ feature.trim() }}}</li>
                    <# }); #>
                </ul>
                <a href="#" class="TR-pricing-button" style="
                    background-color: {{ button_background_color }};
                    color: {{ button_text_color }};
                    border-color: {{ button_border_color }};
                ">{{{ button_text }}}</a>
            </div>
        </div>
        <?php
    }
    
}
