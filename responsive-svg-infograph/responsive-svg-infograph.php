<?php
/**
 * @package responsive_svg_infograph
 * @version 0.1
 */
/*
Plugin Name: Add responsive SVG infographics
Plugin URI: https://github.com/greenpeace/gpes-infographics-wp-shortcode
Description: Shortcode to add responsive SVG infographics. For example: <code>[responsive_svg_infograph id='justAnExample' xl='https://storage.googleapis.com/gpes-static/plasticos/plasticos-1024.svg' l='https://storage.googleapis.com/gpes-static/plasticos/plasticos-730.svg' m='https://storage.googleapis.com/gpes-static/plasticos/plasticos-510.svg' s='https://storage.googleapis.com/gpes-static/plasticos/plasticos-360.svg']</code> &bull; <a target="_blank" href="https://greenpeace.github.io/gpes-visualisations/sizes-formats-files.html">More information about SVG infographics</a>
Author: Osvaldo Gago
Text Domain: responsive-svg-infograph
Domain Path: /languages
Version: 0.1 
Author URI: https://osvaldo.pt
*/

defined( 'ABSPATH' ) or die( 'You can\'t do that !' );

/**
 * Initiate plugin's translations
 */
function responsive_svg_infograph_load_plugin_textdomain() {
    load_plugin_textdomain( 'responsive-svg-infograph', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'responsive_svg_infograph_load_plugin_textdomain' );

/**
 * Shortcode to add responsive SVG infographics.
 * [responsive_svg_infograph id='justAnExample' xl='https://storage.googleapis.com/gpes-static/plasticos/plasticos-1024.svg' l='https://storage.googleapis.com/gpes-static/plasticos/plasticos-730.svg' m='https://storage.googleapis.com/gpes-static/plasticos/plasticos-510.svg' s='https://storage.googleapis.com/gpes-static/plasticos/plasticos-360.svg']
 * @param  array $atts  Shortcode attributes
 * @param  array $content  Shortcode content
 * @param  array $tag  Shortcode tag
 * @return string Templated data
 */
function shortcode_responsive_svg_infograph($atts = [], $content = null, $tag = '') {

    $atts = array_change_key_case((array)$atts, CASE_LOWER);

    $attributes = shortcode_atts([
        'id' => 'infograph-' . rand(1, 100000),
        'xl' => '',
        'l' => '',
        'm' => '',
        's' => ''

    ], $atts, $tag);
    
    $output = '';
    $output .= '<div id="' . sanitize_html_class( $attributes['id'] ) . '" style="width: 100%;">' ;
    $output .= '</div>';
    $output .= '<script type="application/javascript">';
    $output .= '
    
    document.addEventListener("DOMContentLoaded", function (t) {
        var s, e = "' . esc_url( $attributes['s'] ) . '",
            o = "' . esc_url( $attributes['m'] ) . '",
            a = "' . esc_url( $attributes['l'] ) . '",
            i = "' . esc_url( $attributes['xl'] ) . '",
            g = document.getElementById("' . sanitize_html_class( $attributes['id'] ) . '"),
            p = g.offsetWidth,
            c = p;
        p < 435 ? s = e : p >= 435 && p < 620 ? s = o : p >= 620 && p < 878 ? s = a : p >= 878 && (s = i);
        var l = document.createElement("object");
        l.setAttribute("type", "image/svg+xml"), l.setAttribute("width", c), l.setAttribute("height", "auto"), l.setAttribute("data", s), g.appendChild(l)
    }); 

    ';
    $output .= '</script>';

    return $output;

}

add_shortcode('responsive_svg_infograph', 'shortcode_responsive_svg_infograph');

?>
