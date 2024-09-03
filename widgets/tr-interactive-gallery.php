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

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $unique_id = 'gallery-' . $this->get_id(); // Generate unique ID for the gallery
    
        // Enqueue necessary styles and scripts
        wp_enqueue_style('custom-widget-css');
        wp_enqueue_script('custom-widget-js');
        ?>
        
        <div id="<?php echo esc_attr($unique_id); ?>" class="gallery">
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
    
                    function rotateImages() {
                        images.hide();
                        images.eq(currentIndex).show();
                        currentIndex = (currentIndex + 1) % images.length;
                    }
    
                    setInterval(rotateImages, 3000); // Change image every 3 seconds
                    rotateImages(); // Initial call to display the first image
                });
            })(jQuery);
        </script>
        
        <?php
    }
    

    protected function _content_template() {
        ?>
        <#
        var galleryImages = settings.gallery_images;
        #>
        <div class="gallery">
            <# _.each(galleryImages, function(image) { #>
                <img src="{{ image.image.url }}" alt="Gallery Image">
            <# }); #>
        </div>
        <?php
    }
}
