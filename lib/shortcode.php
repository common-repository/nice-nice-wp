<?php
/**
 * Nice Nice WP shortcode.
 *
 * @package Fat_NiceNice_WP
 *
 * @since 1.1.0
 */

/** Add the [nicenice] shortcode */
add_shortcode( 'nicenice', 'fat_nicenice_shortcode' );

function fat_nicenice_shortcode( $atts ) {
	extract( shortcode_atts( array(
		'align' => '',
		'height' => get_option('embed_size_h'),
		'width' => get_option('embed_size_w'),
		'fiveo' => isset($atts['fiveo'])
	), $atts ) );

	/** Check if 5.0 mode is enabled */
	if ( $fiveo ) {
		$fiveo = '5.0';
	}

	/** Set a default width of 500px */
	if ( ! $height && ! $width ) {
		$width = '500';
	}

	/** Ensure height and width are set */
	if ( ! $width ) {
		$width = $height;
	}

	if ( ! $height ) {
		$height = $width;
	}

	/** Set up the allowed alignment options */
	$allowed_alignment = array (
		'left' => 'alignleft',
		'right' => 'alignright',
		'center' => 'aligncenter',
		'none'	=> 'alignnone',
		''		=> 'alignnone'
	);

	/** Set a fallback for disallowed alignments */
	if ( ! in_array( $align, array_keys( $allowed_alignment ) ) ) {
		$align = 'alignnone';
	}

	/** Make sure the output is sanitized. */
	$align = esc_attr( $allowed_alignment[$align] );
	$niceurl = esc_url( 'http://nicenicejpg.com' );
	$width = esc_attr( $width );
	$height = esc_attr( $height );


	/** Prep the embed to be output on the front end */
	$embed = '<img class="'. $align .'" src="'. $niceurl .'/'. $fiveo .'/'. $width .'/'. $height .'" height="'. $height .'" width="'. $width .'" alt="'. __('Nice Nice Baby', 'nicenicewp') .'" />';

	return apply_filters( 'embed_nicenice', $embed, $align, $niceurl, $fiveo, $width, $height );
}