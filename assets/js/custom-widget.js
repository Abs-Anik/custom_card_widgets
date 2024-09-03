// jQuery(document).ready(function($) {
//     // Add any custom JavaScript for widget interactions here
// });

// Custom js pricing table

// document.addEventListener('DOMContentLoaded', function() {
//     document.querySelectorAll('.TR-pricing-toggle input[type="checkbox"]').forEach(toggle => {
//         toggle.addEventListener('change', function() {
//             const isYearly = this.checked;
//             document.querySelectorAll('.TR-pricing-card').forEach(card => {
//                 const monthlyPrice = card.getAttribute('data-monthly-price');
//                 const yearlyPrice = card.getAttribute('data-yearly-price');
//                 const button = card.querySelector('.TR-pricing-button');
//                 if (button) {
//                     button.textContent = isYearly ? `Start Now - $${yearlyPrice}` : `Start Now - $${monthlyPrice}`;
//                 }
//             });
//         });
//     });
// });

document.addEventListener('DOMContentLoaded', function() {
    if (typeof elementor !== 'undefined') {
        elementor.hooks.addAction('frontend/element_ready/tr_interactive_pricing_table.default', function($element) {
            var settings = elementorFrontend.getEditedElementSettings($element);

            var toggle = $element.find('.TR-pricing-toggle input[type="checkbox"]');
            toggle.on('change', function() {
                var isYearly = this.checked;
                $element.find('.TR-pricing-card').each(function() {
                    var monthlyPrice = $(this).data('monthly-price');
                    var yearlyPrice = $(this).data('yearly-price');
                    var button = $(this).find('.TR-pricing-button');
                    if (button.length) {
                        button.text(isYearly ? `Start Now - $${yearlyPrice}` : `Start Now - $${monthlyPrice}`);
                    }
                });
            });

            // Apply dynamic styles for hover effects
            var button = $element.find('.TR-pricing-button');
            var button_background_color = settings.button_background_color ? settings.button_background_color : '#0073e6';
            var button_text_color = settings.button_text_color ? settings.button_text_color : '#ffffff';
            var button_border_color = settings.button_border_color ? settings.button_border_color : '#0073e6';
            var button_hover_background_color = settings.button_hover_background_color ? settings.button_hover_background_color : '#005bb5';
            var button_hover_text_color = settings.button_hover_text_color ? settings.button_hover_text_color : '#ffffff';
            var button_hover_border_color = settings.button_hover_border_color ? settings.button_hover_border_color : '#005bb5';

            button.css({
                'background-color': button_background_color,
                'color': button_text_color,
                'border-color': button_border_color
            });

            // Apply hover effects using CSS
            $element.find('.TR-pricing-button').each(function() {
                $(this).data('hover-background-color', button_hover_background_color);
                $(this).data('hover-text-color', button_hover_text_color);
                $(this).data('hover-border-color', button_hover_border_color);
            });

            // Hover effect logic
            button.hover(
                function() {
                    $(this).css({
                        'background-color': $(this).data('hover-background-color'),
                        'color': $(this).data('hover-text-color'),
                        'border-color': $(this).data('hover-border-color')
                    });
                },
                function() {
                    $(this).css({
                        'background-color': button_background_color,
                        'color': button_text_color,
                        'border-color': button_border_color
                    });
                }
            );

            // Trigger the change event to set the initial state of the button
            toggle.trigger('change');
        });
    }
});
