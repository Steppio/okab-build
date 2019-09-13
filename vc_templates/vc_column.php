<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$padding = $animation = $min_height = $xld = $ld = $sd = $xsd = $bg_image = $bg_pattern = $style = $width = '';
extract( shortcode_atts( array(
	'id'                     => '',
	'class'                  => '',
	'style'                  => '',
	'width'                  => '',
	'xld'                    => '',
	'ld'                     => '',
	'sd'                     => '',
	'xsd'                    => '12',
	'visibility_xld'         => '',
	'visibility_ld'          => '',
	'visibility_md'          => '',
	'visibility_sd'          => '',
	'visibility_xsd'         => '',
	'animation'              => '',
	'delay'                  => '',
	'delay_offset'           => '',
	'bg_color'               => '',
	'bg_video'               => '',
	'bg_image'               => '',
	'bg_pattern'             => '',
	'dark'                   => false,
	'cover'                  => false,
	'no_padding'             => false,
	'min_height'             => '',
	'top_and_bottom_padding' => '',
	'left_and_right_padding' => '',
	'parallax'               => false,
	'parallax_start'         => '0%',
	'parallax_center'        => '50%',
	'parallax_end'           => '100%',

), $atts ) );

$id          = ( $id != '' ) ? 'id="' . esc_attr( $id ) . '"' : '';
$col_class[] = ( $class != '' ) ? esc_attr( $class ) : '';
$col_class[] = ( esc_attr( $xld ) ) ? 'ok-xld-' . esc_attr( $xld ) : '';
$col_class[] = ( esc_attr( $ld ) ) ? 'ok-ld-' . esc_attr( $ld ) : '';
$col_class[] = ( esc_attr( $sd ) ) ? 'ok-sd-' . esc_attr( $sd ) : '';
$col_class[] = ( esc_attr( $xsd ) ) ? 'ok-xsd-' . esc_attr( $xsd ) : '';

if ( $visibility_xld != '' ) {
	$visibility_xld = explode( ',', $visibility_xld );
	$col_class[]    = ( esc_attr( $visibility_xld[0] ) != '' ) ? '' . esc_attr( $visibility_xld[0] ) . '-xld' : '';
}
if ( $visibility_ld != '' ) {
	$visibility_ld = explode( ',', $visibility_ld );
	$col_class[]   = ( esc_attr( $visibility_ld[0] ) != '' ) ? '' . esc_attr( $visibility_ld[0] ) . '-ld' : '';
}
if ( $visibility_md != '' ) {
	$visibility_md = explode( ',', $visibility_md );
	$col_class[]   = ( esc_attr( $visibility_md[0] ) != '' ) ? '' . esc_attr( $visibility_md[0] ) . '-md' : '';
}
if ( $visibility_sd != '' ) {
	$visibility_sd = explode( ',', $visibility_sd );
	$col_class[]   = ( esc_attr( $visibility_sd[0] ) != '' ) ? '' . esc_attr( $visibility_sd[0] ) . '-sd' : '';
}
if ( $visibility_xsd != '' ) {
	$visibility_xsd = explode( ',', $visibility_xsd );
	$col_class[]    = ( esc_attr( $visibility_xsd[0] ) != '' ) ? '' . esc_attr( $visibility_xsd[0] ) . '-xsd' : '';
}

$bg_color   = ( $bg_color != '' ) ? 'data-bg-color="' . esc_attr( $bg_color ) . '"' : '';
$cover      = ( $cover == 'true' ) ? '<div class="dima-section-cover"></div>' : '';
$bg_image   = ( $bg_image != '' ) ? '' . esc_attr( $bg_image ) . '' : '';
$bg_pattern = ( $bg_pattern != '' ) ? $bg_pattern : '';
$bg_class   = ( $bg_pattern != '' ) ? ' background-image-hide dima-pattern-image' : ' background-image-hide background-cover';
$dark       = ( $dark == 'true' ) ? ' dark-bg' : '';

if ( is_numeric( $bg_image ) ) {
	$bg_image_info = wp_get_attachment_image_src( $bg_image, 'full' );
	$bg_image      = $bg_image_info[0];
}

if ( is_numeric( $bg_pattern ) ) {
	$bg_pattern_info = wp_get_attachment_image_src( $bg_pattern, 'full' );
	$bg_pattern      = $bg_pattern_info[0];
}


if ( $top_and_bottom_padding != '' && $left_and_right_padding == '' ) {
	$padding .= 'padding-top:' . $top_and_bottom_padding . '; padding-bottom:' . $top_and_bottom_padding . ';';
} elseif ( $top_and_bottom_padding == '' && $left_and_right_padding != '' ) {
	$padding .= 'padding-right:' . $left_and_right_padding . '; padding-left:' . $left_and_right_padding . ';';
} elseif ( $top_and_bottom_padding != '' && $left_and_right_padding != '' ) {
	$padding .= 'padding: ' . $top_and_bottom_padding . ' ' . $left_and_right_padding . ';';
}
$padding .= ( $min_height != '' ) ? 'min-height: ' . $min_height . ';' : '';

if ( $padding != '' ) {
	$padding = 'style="' . $padding . '"';
}


$style = ( $style != '' ) ? 'style="' . $style . '"' : '';

$delay        = ( $delay != '' ) ? ' data-delay=' . $delay . '' : '';
$delay_offset = ( $delay_offset != '' ) ? ' data-offset=' . $delay_offset . '' : '';
$animation    = ( $animation != '' ) ? 'data-animate=' . $animation . '' : '';

switch ( $width ) {
	case '1/1' :
		$width = 'ok-md-12';
		break;
	case '1/2' :
		$width = 'ok-md-6';
		break;
	case '1/3' :
		$width = 'ok-md-4';
		break;
	case '2/3' :
		$width = 'ok-md-8';
		break;
	case '1/4' :
		$width = 'ok-md-3';
		break;
	case '3/4' :
		$width = 'ok-md-9';
		break;
	case '1/6' :
		$width = 'ok-md-2';
		break;
	case '5/6' :
		$width = 'ok-md-10';
		break;
	case '5/12' :
		$width = 'ok-md-5';
		break;
	case '7/12' :
		$width = 'ok-md-7';
		break;
	default:
		$width = 'ok-md-12';
		break;
}

$col_class[] = $width;

if ( $this->settings['base'] == 'vc_column' ) {
	$col_class[] = 'column_parent';
} else {
	$col_class[] = 'column_child';
}

$class = esc_attr( trim( implode( ' ', $col_class ) ) );
if ( empty( $bg_image ) && empty( $bg_pattern ) ) {
	$output = "<div {$id} class=\"{$class}\" {$style} {$animation} {$delay} {$delay_offset} {$bg_color}>"
	          . '<div class="page-section ' . $dark . '" ' . $padding . '>'
	          . '<div class="uncoltable page-section">'
	          . '<div class="uncell">'
	          . do_shortcode( $content )
	          . '</div>'
	          . '</div>'
	          . '</div>'
	          . "</div>";
} else {
	$bg_image = ( $bg_image == '' ) ? $bg_pattern : $bg_image;

	if ( $parallax == 'parallax' ) {
		$parallax_start  = ( $parallax_start != '' ) ? 'data-parallax-start="' . esc_attr( $parallax_start ) . '"' : '';
		$parallax_center = ( $parallax_center != '' ) ? 'data-parallax-center="' . esc_attr( $parallax_center ) . '"' : '';
		$parallax_end    = ( $parallax_end != '' ) ? 'data-parallax-end="' . esc_attr( $parallax_end ) . '"' : '';

		$output = "<div {$id} class=\"{$class}\" {$style} {$animation} {$delay} {$delay_offset} {$bg_color}>"
		          . '<div class="' . $dark . '" ' . $padding . '>'
		          . '<div class="' . $bg_class . ' parallax-background" ' . $parallax_start . ' ' . $parallax_center . ' ' . $parallax_end . ' data-bg-image="' . $bg_image . '">'
		          . '</div>'
		          . '' . $cover . ''
		          . '<div class="uncoltable page-section">'
		          . '<div class="uncell">'
		          . do_shortcode( $content )
		          . '</div>'
		          . '</div>'
		          . '</div>'
		          . '</div>';
	} elseif ( $parallax == 'fixed_parallax' ) {
		$output = "<div {$id} class=\"{$class}\" {$style} {$animation} {$delay} {$delay_offset} {$bg_color}>"
		          . '<div class="' . $dark . '" ' . $padding . ' >'
		          . '<div class="fixed-parallax ' . $bg_class . '" data-bg-image="' . $bg_image . '">'
		          . '</div>'
		          . '' . $cover . ''
		          . '<div class="uncoltable page-section">'
		          . '<div class="uncell">'
		          . do_shortcode( $content )
		          . '</div>'
		          . '</div>'
		          . '</div>'
		          . '</div>';
	} else {
		$output = "<div {$id} class=\"{$class}\" {$style} {$animation} {$delay} {$delay_offset} {$bg_color}>"
		          . '<div class="' . $dark . '" ' . $padding . '>'
		          . '<div class="' . $bg_class . '" data-bg-image="' . $bg_image . '">'
		          . '</div>'
		          . '' . $cover . ''
		          . '<div class="uncoltable page-section">'
		          . '<div class="uncell">'
		          . do_shortcode( $content )
		          . '</div>'
		          . '</div>'
		          . '</div>'
		          . '</div>';
	}
}

if ( ! empty( $bg_video ) ) {
	wp_enqueue_script( 'video-js' );
	wp_enqueue_script( 'bigvideo-js' );

	$output = "<div {$id} class=\"{$class}\" {$style} {$animation} {$delay} {$delay_offset} {$bg_color}>"
	          . '' . $cover . ''
	          . '<div class="page-section-content ' . $dark . '" ' . $padding . '>'
	          . '<div class="' . $bg_class . ' parallax-background video-wrap" data-video-wrap="' . $bg_video . '" data-img-wrap="' . $bg_image . '">'
	          . '</div>'
	          . '<div class="uncoltable page-section">'
	          . '<div class="uncell">'
	          . do_shortcode( $content )
	          . '</div>'
	          . '</div>'
	          . '</div>'
	          . '</div>';

}

echo wpb_js_remove_wpautop( $output );