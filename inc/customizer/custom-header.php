<?php
/**
 * Custom Header
 */

add_action('after_setup_theme', 'abraham_custom_header_setup');

function abraham_custom_header_setup() {
    add_theme_support('custom-header', apply_filters('abraham_custom_header_args',
        array(
            'default-image'          => '',
            'default-text-color'     => 'FFFFFF',
            'width'                  => 1920,
            'height'                 => 400,
            'flex-height'            => true,
            'wp-head-callback'       => 'abraham_header_style',
        )
    ));
}

if (!function_exists('abraham_header_style')) :

function abraham_header_style() {
    $header_text_color = get_header_textcolor();

    if (HEADER_TEXTCOLOR === $header_text_color) {
        return;
    } ?>

	<style id="custom-header-css">
	<?php if (!display_header_text()) : ?>

		#site-title,#site-description{position:absolute;clip:rect(1px,1px,1px,1px)}

	<?php else : ?>

        #header{color:#<?php echo esc_attr( $header_text_color ); ?>}

	<?php endif; ?>

    <?php if (get_header_image()) { ?>
        #header{background-image:url( <?php header_image(); ?> )}
    <?php } ?>
	</style>

<?php }
endif; // abraham_header_style
