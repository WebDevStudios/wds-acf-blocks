<?php
/**
 * All of our fun and important queries.
 *
 * @author Corey Collins
 * @since 1.0
 * @package wds-acf-blocks
 */

/**
 * Get recent posts.
 *
 * If no taxonomies are provided, the most recent posts will be displayed.
 * Otherwise, posts from specified categories and tags will be displayed.
 *
 * @param  array $args   WP_Query arguments.
 * @return object        The related posts object.
 * @author Greg Rickaby, Eric Fuller, Jeffrey de Wit
 * @since 1.0
 */
function wds_acf_blocks_get_recent_posts( $args = array() ) {

	// Setup default WP_Query args.
	$defaults = array(
		'ignore_sticky_posts'    => 1,
		'no_found_rows'          => false,
		'orderby'                => 'date',
		'order'                  => 'DESC',
		'paged'                  => 1,
		'posts_per_page'         => 3,
		'post__not_in'           => array( get_the_ID() ),
		'update_post_meta_cache' => false,
		'update_post_term_cache' => false,
	);

	// Parse arguments.
	$args = wp_parse_args( $args, $defaults );

	// Run the query!
	$recent_posts = new WP_Query( $args );

	return $recent_posts;
}

/**
 * Get recent posts query arguments.
 *
 * @author Ashar Irfan
 * @since 1.0
 *
 * @param array $categories List of categories.
 * @param array $tags List of tags.
 * @return array
 */
function wds_acf_blocks_get_recent_posts_query_arguments( $categories, $tags ) {

	$args = array();

	// If no tags and just categories.
	if ( ! $tags && $categories ) {
		$args['category__in'] = $categories;
	}

	// If no categories and just tags.
	if ( ! $categories && $tags ) {
		$args['tag__in'] = $tags;
	}

	// If both categories and tags.
	if ( $categories && $tags ) {
		$args = array_merge(
			$args,
			array(
				'tax_query' => array(
					'relation' => 'OR',
					array(
						'taxonomy' => 'category',
						'terms'    => $categories,
					),
					array(
						'taxonomy' => 'post_tag',
						'terms'    => $tags,
					),
				),
			)
		);
	}

	return $args;
}
