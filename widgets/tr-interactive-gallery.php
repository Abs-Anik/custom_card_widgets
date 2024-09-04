<?php
/**
 * TR Interactive Gallery Widget
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TR_Interactive_Gallery_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'tr_interactive_gallery';
    }

    public function get_title() {
        return __('TR Interactive Gallery', 'tr-addons');
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
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

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => __('Choose Image', 'tr-addons'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'gallery_images',
            [
                'label' => __('Gallery Images', 'tr-addons'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'image' => ['url' => \Elementor\Utils::get_placeholder_image_src()],
                    ],
                    [
                        'image' => ['url' => \Elementor\Utils::get_placeholder_image_src()],
                    ],
                ],
                'title_field' => '{{{ image.url }}}',
            ]
        );

        // Add transition effect control
        $this->add_control(
            'transition_effect',
            [
                'label' => __('Transition Effect', 'tr-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'fade' => __('Fade', 'tr-addons'),
                    'slide' => __('Slide', 'tr-addons'),
                    'zoom' => __('Zoom', 'tr-addons'),
                ],
                'default' => 'fade',
            ]
        );

        // Add animation control
        $this->add_control(
            'animation',
            [
                'label' => __('Animation', 'tr-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('On', 'tr-addons'),
                'label_off' => __('Off', 'tr-addons'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        // Add animation speed control
        $this->add_control(
            'animation_speed',
            [
                'label' => __('Animation Speed (s)', 'tr-addons'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 10,
                'min' => 1,
                'step' => 1,
                'condition' => [
                    'animation' => 'yes',
                ],
            ]
        );

        // Add padding control
        $this->add_control(
            'gallery_padding',
            [
                'label' => __('Padding', 'tr-addons'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 14,
                'min' => 0,
                'step' => 1,
                'description' => __('Set the padding for the gallery.', 'tr-addons'),
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Style', 'tr-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Add gradient angle control
        $this->add_control(
            'gradient_angle',
            [
                'label' => __('Gradient Angle', 'tr-addons'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 45,
                'min' => 0,
                'max' => 360,
                'step' => 1,
            ]
        );

        // Add gradient color controls
        $this->add_control(
            'gradient_color_1',
            [
                'label' => __('Gradient Color 1', 'tr-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#006400',
            ]
        );

        $this->add_control(
            'gradient_color_2',
            [
                'label' => __('Gradient Color 2', 'tr-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#228B22',
            ]
        );

        $this->add_control(
            'gradient_color_3',
            [
                'label' => __('Gradient Color 3', 'tr-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#B22222',
            ]
        );

        $this->add_control(
            'gradient_color_4',
            [
                'label' => __('Gradient Color 4', 'tr-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FF0000',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $unique_id = 'gallery-' . $this->get_id(); // Generate unique ID for the gallery

        // Enqueue necessary styles and scripts
        wp_enqueue_style('custom-widget-css');
        wp_enqueue_script('custom-widget-js');

        $animation_class = $settings['animation'] === 'yes' ? 'animating' : '';
        $animation_speed = $settings['animation_speed'];
        $padding = $settings['gallery_padding'];

        ?>
        
        <div id="<?php echo esc_attr($unique_id); ?>" class="gallery <?php echo esc_attr($animation_class); ?>" style="--gradient-angle: <?php echo esc_attr($settings['gradient_angle']); ?>deg; --color1: <?php echo esc_attr($settings['gradient_color_1']); ?>; --color2: <?php echo esc_attr($settings['gradient_color_2']); ?>; --color3: <?php echo esc_attr($settings['gradient_color_3']); ?>; --color4: <?php echo esc_attr($settings['gradient_color_4']); ?>; --animation-speed: <?php echo esc_attr($animation_speed); ?>s; --padding: <?php echo esc_attr($padding); ?>px;">
            <?php foreach ($settings['gallery_images'] as $image) : ?>
                <img src="<?php echo esc_url($image['image']['url']); ?>" alt="Gallery Image">
            <?php endforeach; ?>
        </div>
        
        <script>
            (function($) {
                $(document).ready(function() {
                    var $gallery = $('#<?php echo esc_attr($unique_id); ?>');
                    var images = $gallery.find('img');
                    var currentIndex = 0;

                    // Initially, show the first image
                    images.eq(currentIndex).addClass('active');

                    function rotateImages() {
                        images.eq(currentIndex).removeClass('active');
                        currentIndex = (currentIndex + 1) % images.length;
                        images.eq(currentIndex).addClass('active');
                    }

                    var transitionEffect = '<?php echo $settings['transition_effect']; ?>';
                    var intervalTime = 3000;

                    if (transitionEffect === 'fade') {
                        images.css('transition', 'opacity 1s');
                    } else if (transitionEffect === 'slide') {
                        images.css('transition', 'transform 1s');
                    } else if (transitionEffect === 'zoom') {
                        images.css('transition', 'transform 1s');
                    }

                    setInterval(rotateImages, intervalTime); 
                });
            })(jQuery);
        </script>

        <?php
    }

    protected function _content_template() {
        ?>
        <#
        var galleryImages = settings.gallery_images;
        var animationClass = settings.animation === 'yes' ? 'animating' : '';
        var gradientAngle = settings.gradient_angle;
        var color1 = settings.gradient_color_1;
        var color2 = settings.gradient_color_2;
        var color3 = settings.gradient_color_3;
        var color4 = settings.gradient_color_4;
        var animationSpeed = settings.animation_speed;
        var padding = settings.gallery_padding;
        #>
        <div class="gallery {{ animationClass }}" style="--gradient-angle: {{ gradientAngle }}deg; --color1: {{ color1 }}; --color2: {{ color2 }}; --color3: {{ color3 }}; --color4: {{ color4 }}; --animation-speed: {{ animationSpeed }}s; --padding: {{ padding }}px;">
            <# _.each(galleryImages, function(image) { #>
                <img src="{{ image.image.url }}" alt="Gallery Image">
            <# }); #>
        </div>
        <script>
            (function($) {
                $(document).ready(function() {
                    var $gallery = $('.gallery');
                    var images = $gallery.find('img');
                    var currentIndex = 0;

                    // Initially, show the first image
                    images.eq(currentIndex).addClass('active');

                    function rotateImages() {
                        images.eq(currentIndex).removeClass('active');
                        currentIndex = (currentIndex + 1) % images.length;
                        images.eq(currentIndex).addClass('active');
                    }

                    var transitionEffect = '{{ settings.transition_effect }}';
                    var intervalTime = 3000;

                    if (transitionEffect === 'fade') {
                        images.css('transition', 'opacity 1s');
                    } else if (transitionEffect === 'slide') {
                        images.css('transition', 'transform 1s');
                    } else if (transitionEffect === 'zoom') {
                        images.css('transition', 'transform 1s');
                    }

                    setInterval(rotateImages, intervalTime); 
                });
            })(jQuery);
        </script>
        <?php
    }
}
