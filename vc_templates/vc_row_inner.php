<?php
$section_content = $class = $padding = $bg_image = $style = $bg_pattern =
$top_and_bottom_padding = $left_and_right_padding = $no_padding = '';

extract( shortcode_atts( array(
	'id'                     => '',
	'style'                  => '',
	'class'                  => '',
	'bg_color'               => '',
	'bg_image'               => '',
	'bg_pattern'             => '',
	'no_margin'              => false,
	'dark'                   => false,
	'cover'                  => false,
	'bg_video'               => '',
	'full_width'             => '',
	'no_padding'             => false,
	'top_and_bottom_padding' => '',
	'left_and_right_padding' => '',
	'parallax'               => false,
	'parallax_start'         => '0%',
	'parallax_center'        => '50%',
	'parallax_end'           => '100%',
	'equal_height'           => false,
), $atts, 'section_row_inner' ) );

wp_enqueue_script( 'magnific-js' );
wp_enqueue_script( 'dima-owl' );

if ( $top_and_bottom_padding != '' && $left_and_right_padding == '' ) {
	$padding .= 'style="padding-top:' . $top_and_bottom_padding . '; padding-bottom:' . $top_and_bottom_padding . ';"';
} elseif ( $top_and_bottom_padding == '' && $left_and_right_padding != '' ) {
	$padding .= 'style="padding-right:' . $left_and_right_padding . '; padding-left:' . $left_and_right_padding . ';"';
} elseif ( $top_and_bottom_padding != '' && $left_and_right_padding != '' ) {
	$padding .= 'style="padding: ' . $top_and_bottom_padding . ' ' . $left_and_right_padding . ';"';
}

$demo        = dima_helper::dima_get_demo();
$id          = ( $id != '' ) ? 'id="' . esc_attr( $id ) . '"' : '';
$row_class[] = ( $class != '' ) ? esc_attr( $class ) . ' ' : '';
$bg_color    = ( $bg_color != '' ) ? 'data-bg-color="' . esc_attr( $bg_color ) . '"' : '';
$cover       = ( $cover == 'true' ) ? '<div class="dima-section-cover"></div>' : '';
$no_margin   = ( $no_margin == 'true' ) ? 'no-margin' : '';
$bg_image    = ( $bg_image != '' ) ? '' . esc_attr( $bg_image ) . '' : '';
$style       = ( $style != '' ) ? 'style="' . $style . '"' : '';
$bg_pattern  = ( $bg_pattern != '' ) ? $bg_pattern : '';
$bg_class    = ( $bg_pattern != '' ) ? ' background-image-hide dima-pattern-image' : ' background-image-hide background-cover';
$dark        = ( $dark == 'true' ) ? ' dark-bg' : '';
$row_class[] = ( $equal_height == 'true' ) ? 'dima-equal' : '';
$row_class[] = 'section';

if ( is_numeric( $bg_image ) ) {
	$bg_image_info = wp_get_attachment_image_src( $bg_image, 'full' );
	$bg_image      = $bg_image_info[0];
}

if ( is_numeric( $bg_pattern ) ) {
	$bg_pattern_info = wp_get_attachment_image_src( $bg_pattern, 'full' );
	$bg_pattern      = $bg_pattern_info[0];
}

$row_content = '<div class="ok-row ' . $no_margin . '">' . do_shortcode( $content ) . '</div>';

if ( $full_width == 'full_width' ) {
	$content_global  = '<div>'
	                   . $row_content
	                   . '</div>';
	$section_content = 'no-padding-section ';
} elseif ( $full_width == 'wrap' ) {
	$content_global  = '<div class="full-wrapper page-section">'
	                   . $row_content
	                   . '</div>';
	$section_content = '';
} else {
	$section_layout = dima_get_section_layout_meta();

	if ( $section_layout == "full-width" ) {
		$content_global = '<div class="container page-section">'
		                  . $row_content
		                  . '</div>';
	} else {
		$content_global = '<div class="page-section">'
		                  . $row_content
		                  . '</div>';
	}

	$section_content = '';
}

if ( $no_padding ) {
	$section_content = 'no-padding-section ';
}

//no background image
if ( empty( $bg_image ) && empty( $bg_pattern ) ) {
	$output = '<section ' . $id . ' class="' . esc_attr( trim( implode( ' ', $row_class ) ) ) . '" ' . $style . '>'
	          . '<div class="' . $section_content . 'page-section-content ' . $dark . '" ' . $padding . ' ' . $bg_color . '>'
	          . $content_global
	          . '</div>'
	          . '</section>';
} else {

	$bg_image = ( $bg_image == '' ) ? $bg_pattern : $bg_image;

	if ( $parallax == 'parallax' ) {
		$parallax_start  = ( $parallax_start != '' ) ? 'data-parallax-start="' . esc_attr( $parallax_start ) . '"' : '';
		$parallax_center = ( $parallax_center != '' ) ? 'data-parallax-center="' . esc_attr( $parallax_center ) . '"' : '';
		$parallax_end    = ( $parallax_end != '' ) ? 'data-parallax-end="' . esc_attr( $parallax_end ) . '"' : '';

		$output = '<section ' . $id . ' class="' . esc_attr( trim( implode( ' ', $row_class ) ) ) . '" ' . $style . '>'
		          . '<div class="' . $section_content . 'page-section-content' . $dark . ' overflow-hidden" ' . $padding . '>'
		          . '<div class="' . $bg_class . ' parallax-background" ' . $parallax_start . ' ' . $parallax_center . ' ' . $parallax_end . ' data-bg-image="' . $bg_image . '">'
		          . '</div>'
		          . '' . $cover . ''
		          . $content_global
		          . '</div>'
		          . '</section>';
	} elseif ( $parallax == 'fixed_parallax' ) {
		$output = '<section ' . $id . ' class="' . esc_attr( trim( implode( ' ', $row_class ) ) ) . '" ' . $style . '>'
		          . '<div class="' . $section_content . 'page-section-content ' . $dark . ' overflow-hidden" ' . $padding . ' >'
		          . '<div class="fixed-parallax ' . $bg_class . '" data-bg-image="' . $bg_image . '">'
		          . '</div>'
		          . '' . $cover . ''
		          . $content_global
		          . '</div>'
		          . '</section>';
	} else {
		$output = '<section ' . $id . ' class="' . esc_attr( trim( implode( ' ', $row_class ) ) ) . '" ' . $style . '>'
		          . '<div class="' . $section_content . 'page-section-content ' . $dark . ' overflow-hidden" ' . $padding . '>'
		          . '<div class="' . $bg_class . '" data-bg-image="' . $bg_image . '">'
		          . '</div>'
		          . '' . $cover . ''
		          . $content_global
		          . '</div>'
		          . '</section>';
	}
}

if ( ! empty( $bg_video ) ) {
	wp_enqueue_script( 'video-js' );
	wp_enqueue_script( 'bigvideo-js' );

	$output = '<section ' . $id . ' class="' . esc_attr( trim( implode( ' ', $row_class ) ) ) . 'section" ' . $style . '>'
	          . '<div class="' . $section_content . 'page-section-content ' . $dark . ' overflow-hidden" ' . $padding . '>'
	          . '' . $cover . ''
	          . '<div class="' . $bg_class . ' parallax-background video-wrap" data-video-wrap="' . $bg_video . '" data-img-wrap="' . $bg_image . '">'
	          . '</div>'
	          . $content_global
	          . '</div>'
	          . '</section>';

}

echo $output;