<?php
/**
 * Registers a 'WDS' block category with Gutenberg.
 *
 * @package abs
 */

add_filter(
	'block_categories_all',
	function( $categories ) {

		// Adding a new category.
		$categories[] = array(
			'slug'  => 'WDS',
			'title' => 'WebDevStudios Blocks',
		);

		return $categories;
	}
);
