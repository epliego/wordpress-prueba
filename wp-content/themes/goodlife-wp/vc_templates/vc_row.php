<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
 
$output = $data = $parallax = $video = $height = $parallax_class = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'wpb_composer_front_js' );
$el_class = $this->getExtraClass($el_class);


$nopadding = $column_padding ? 'no-padding ' : ''; 
$row_padding = $row_padding ? 'no-row-padding ' : ''; 
$full_width = $thb_full_width ? 'full_width ' : '';

$css_classes = array(
	'vc_row',
	'row', //deprecated
	'vc_row-fluid',
	$nopadding,
	$row_padding,
	$full_width,
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

// equal heights
if($equal_height == 'true') {
	
	$equal_height = ' data-equal=">.columns" data-row-detection="true"';
	
} else {
	$equal_height = '';
}

$output .= '<div '.($el_id ? 'id="'. esc_attr( $el_id ) .'"' : '') .' class="row '.$full_width.$row_padding.$nopadding.$el_class.vc_shortcode_custom_css_class($css, ' ').'" '.$equal_height.'>';
$output .= wpb_js_remove_wpautop($content);
$output .= '</div>';

echo $output;