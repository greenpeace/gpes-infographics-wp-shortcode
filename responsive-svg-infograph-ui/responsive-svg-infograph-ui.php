<?php
/**
 * Plugin Name: Responsive SVG infographics UI
 * Plugin URI: https://github.com/greenpeace/gpes-infographics-wp-shortcode
 * Version: 0.1
 * Description: Adds an GUI to use the [responsive_svg_infograph] shortcode. This plugin requires the plugin Shortcake (Shortcode UI) and the plugin "Add responsive SVG infographics"
 * Author: Osvaldo Gago
 * Author URI: https://osvaldo.pt
 * Text Domain: responsive-svg-infograph-ui
 * Domain Path: /languages
 */

defined( 'ABSPATH' ) or die( 'You can\'t do that !' );

/**
 * Initiate plugin's translations
 */
function responsive_svg_infograph_ui_load_plugin_textdomain() {
    load_plugin_textdomain( 'responsive-svg-infograph-ui', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'responsive_svg_infograph_ui_load_plugin_textdomain' );

/**
 * Shortcake UI detection
 */
function shortcode_responsive_svg_infograph_detection() {
	if ( ! function_exists( 'shortcode_ui_register_for_shortcode' ) ) {
		add_action( 'admin_notices', 'shortcode_ui_responsive_svg_infograph_notices' );
	}
}

function shortcode_ui_responsive_svg_infograph_notices() {
	if ( current_user_can( 'activate_plugins' ) ) {
		?>
		<div class="error message">
			<p><?php __('The Shortcode UI plugin must be active for the Responsive SVG Infographics UI plugin to function.', 'responsive-svg-infograph-ui') ?></p>
		</div>
		<?php
	}
}

add_action( 'init', 'shortcode_responsive_svg_infograph_detection' );

/**
 * UI for the shortcode responsive_svg_infograph
 */
function shortcode_ui_responsive_svg_infograph() {
    
    $responsive_svg_infograph_fields = array(
        array(
			'label'  => __('Infographic ID', 'responsive-svg-infograph-ui'),
			'description'  => __('A word or words that identifies the infographic, like for example <strong>climateFinance</strong>. Please note that if there is more than one infographic in the same page, each infographic should use a different word.', 'responsive-svg-infograph-ui'),
			'attr'   => 'id',
			'type'   => 'text',
			'encode' => false,
			'meta'   => array(
				'placeholder' => 'anExample',
				'data-test'   => 1,
			),
		),
        array(
			'label'  => __('URL - XL file', 'responsive-svg-infograph-ui'),
			'description'  => __('URL to the SVG file - 1024px wide.', 'responsive-svg-infograph-ui'),
			'attr'   => 'xl',
			'type'   => 'text',
			'encode' => false,
			'meta'   => array(
				'placeholder' => 'https://',
				'data-test'   => 1,
			),
		
		),
        array(
			'label'  => __('URL - L file', 'responsive-svg-infograph-ui'),
			'description'  => __('URL to the SVG file - 730px wide.', 'responsive-svg-infograph-ui'),
			'attr'   => 'l',
			'type'   => 'text',
			'encode' => false,
			'meta'   => array(
				'placeholder' => 'https://',
				'data-test'   => 1,
			),
		
		),
        array(
			'label'  => __('URL - M file', 'responsive-svg-infograph-ui'),
			'description'  => __('URL to the SVG file - 510px wide.', 'responsive-svg-infograph-ui'),
			'attr'   => 'm',
			'type'   => 'text',
			'encode' => false,
			'meta'   => array(
				'placeholder' => 'https://',
				'data-test'   => 1,
			),
		
		),
        array(
			'label'  => __('URL - S file', 'responsive-svg-infograph-ui'),
			'description'  => __('URL to the SVG file - 360px wide.', 'responsive-svg-infograph-ui'),
			'attr'   => 's',
			'type'   => 'text',
			'encode' => false,
			'meta'   => array(
				'placeholder' => 'https://',
				'data-test'   => 1,
			),
		
		),
    );
    
    $responsive_svg_infograph_args = array(
		'label' => __('Responsive SVG infographic', 'responsive-svg-infograph-ui'),
		'listItemImage' => 'dashicons-admin-site',
		'attrs' => $responsive_svg_infograph_fields,
	);
        
    shortcode_ui_register_for_shortcode( 'responsive_svg_infograph', $responsive_svg_infograph_args );
}

add_action( 'register_shortcode_ui', 'shortcode_ui_responsive_svg_infograph' );

?>
