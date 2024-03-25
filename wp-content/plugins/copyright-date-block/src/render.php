<?php
/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * The following variables are exposed to the file:
 *     $attributes (array): The block attributes.
 *     $content (string): The block default content.
 *     $block (WP_Block): The block instance.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

// Get the current year.
//function for validating the user
function validateUser() {
	if(current_user_can('edit_post')) {
		return $block_content = '<p ' . get_block_wrapper_attributes() . '>© ' . esc_html( $display_date ) . '</p>';
	}
}
function displayBlockContent() {
	// The current year is different from the fallback, so render the updated block content.
	if ( ! empty( $attributes['startingYear'] ) && ! empty( $attributes['showStartingYear'] ) ) {
		return $display_date = $attributes['startingYear'] . '–' . $current_year;
	} else {
		return $display_date = $current_year;
	}
}
add_action('displayBlockContent','validateUser');
//do_action();
$current_year = date( "Y" );

// Determine which content to display.
if ( isset( $attributes['fallbackCurrentYear'] ) && $attributes['fallbackCurrentYear'] === $current_year ) {

	// The current year is the same as the fallback, so use the block content saved in the database (by the save.js function).
	$block_content = $content;
} else {

	displayBlockContent();

	
}

echo wp_kses_post( $block_content );
