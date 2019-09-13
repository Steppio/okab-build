<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$offset_md = $animation = $xld = $ld = $sd = $xsd =
$offset_xld = $offset_ld = $style = $width = '';

extract( shortcode_atts( array(
	'id'             => '',
	'class'          => '',
	'style'          => '',
	'width'          => '',
	'xld'            => '',
	'ld'             => '',
	'sd'             => '6',
	'xsd'            => '12',
	'offset_xld'     => '',
	'offset_ld'      => '',
	'offset_md'      => '',
	'visibility_xld' => '',
	'visibility_ld'  => '',
	'visibility_md'  => '',
	'visibility_sd'  => '',
	'visibility_xsd' => '',
	'animation'      => '',
	'delay'          => '',
	'delay_offset'   => '',

), $atts ) );


$id          = ( $id != '' ) ? 'id="' . esc_attr( $id ) . '"' : '';
$col_class[] = ( $class != '' ) ? esc_attr( $class ) : '';
$col_class[] = ( esc_attr( $xld ) ) ? ' ok-xld-' . esc_attr( $xld ) : '';
$col_class[] = ( esc_attr( $ld ) ) ? ' ok-ld-' . esc_attr( $ld ) : '';
$col_class[] = ( esc_attr( $sd ) ) ? ' ok-sd-' . esc_attr( $sd ) : '';
$col_class[] = ( esc_attr( $xsd ) ) ? ' ok-xsd-' . esc_attr( $xsd ) : '';
$col_class[] = ( esc_attr( $offset_xld ) != '' ) ? ' ok-offset-xld-' . esc_attr( $offset_xld ) : '';
$col_class[] = ( esc_attr( $offset_ld ) != '' ) ? ' ok-offset-ld-' . esc_attr( $offset_ld ) : '';
$col_class[] = ( esc_attr( $offset_md ) != '' ) ? ' ok-offset-md-' . esc_attr( $offset_md ) : '';

if ( $visibility_xld != '' ) {
	$visibility_xld = explode( ',', $visibility_xld );
	$col_class[]    = ( esc_attr( $visibility_xld[0] ) != '' ) ? ' ' . esc_attr( $visibility_xld[0] ) . '-xld' : '';
}
if ( $visibility_ld != '' ) {
	$visibility_ld = explode( ',', $visibility_ld );
	$col_class[]   = ( esc_attr( $visibility_ld[0] ) != '' ) ? ' ' . esc_attr( $visibility_ld[0] ) . '-ld' : '';
}
if ( $visibility_md != '' ) {
	$visibility_md = explode( ',', $visibility_md );
	$col_class[]   = ( esc_attr( $visibility_md[0] ) != '' ) ? ' ' . esc_attr( $visibility_md[0] ) . '-md' : '';
}
if ( $visibility_sd != '' ) {
	$visibility_sd = explode( ',', $visibility_sd );
	$col_class[]   = ( esc_attr( $visibility_sd[0] ) != '' ) ? ' ' . esc_attr( $visibility_sd[0] ) . '-sd' : '';
}
if ( $visibility_xsd != '' ) {
	$visibility_xsd = explode( ',', $visibility_xsd );
	$col_class[]    = ( esc_attr( $visibility_xsd[0] ) != '' ) ? ' ' . esc_attr( $visibility_xsd[0] ) . '-xsd' : '';
}

$style = ( $style != '' ) ? $style : '';

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
$class       = esc_attr( trim( implode( ' ', $col_class ) ) );
$output      = "<div {$id} class=\"{$class}\" style=\"{$style}\" {$animation}{$delay}{$delay_offset}>" . do_shortcode( $content ) . "</div>";

echo $output;