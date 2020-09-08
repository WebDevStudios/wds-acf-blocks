<?php
/**
 * Hooks and filters.
 *
 * @author Corey Collins
 * @since 1.0
 * @package wds-acf-blocks
 */

/**
 * Specify the location for saving ACF JSON files.
 * Only enable this filter when you actually need to create new field groups, or edit existing field groups.
 * If this is always on, any time a new field group is added on a project the field group will be saved to this plugin. You probably don't want that!
 *
 * @param string $path The path we're saving the files.
 * @return string $path
 * @author Corey Collins
 * @since 1.0
 */
function wds_acf_blocks_acf_json_save_point( $path ) {

	// Update the path.
	$path = plugin_dir_path( dirname( __FILE__ ) ) . '/acf-json';

	return $path;
}
// add_filter( 'acf/settings/save_json', 'wds_acf_blocks_acf_json_save_point' );

/**
 * Specify the location for loading ACF JSON files.
 *
 * @param string $paths The paths from which we're loading the files.
 * @return string $paths
 * @author Corey Collins
 * @since 1.0
 */
function wds_acf_blocks_acf_json_load_point( $paths ) {

	// Remove original path (optional).
	unset( $paths[0] );

	// Append the new path.
	$paths[] = plugin_dir_path( dirname( __FILE__ ) ) . '/acf-json';

	return $paths;
}
add_filter( 'acf/settings/load_json', 'wds_acf_blocks_acf_json_load_point' );

/**
 * Register our ACF Blocks.
 *
 * @author Corey Collins
 */
function wds_acf_blocks_acf_init() {

	$supports = array(
		'align'  => array( 'wide', 'full' ),
		'anchor' => true,
	);

	// Register our Accordion block.
	acf_register_block_type(
		array(
			'name'            => 'wds-accordion',
			'title'           => esc_html__( 'Accordion', 'wds-acf-blocks' ),
			'description'     => esc_html__( 'A custom set of collapsable accordion items.', 'wds-acf-blocks' ),
			'render_callback' => 'wds_acf_blocks_acf_block_registration_callback',
			'category'        => 'wds-blocks',
			'icon'            => 'sort',
			'keywords'        => array( 'accordion', 'wds' ),
			'mode'            => 'preview',
			'enqueue_assets'  => 'wds_acf_blocks_acf_enqueue_backend_block_styles',
			'align'           => 'wide',
			'supports'        => $supports,
			'example'         => array(
				'attributes' => array(
					'data' => array(
						'title'           => esc_html__( 'Accordion Block Title', 'wds-acf-blocks' ),
						'text'            => esc_html__( 'Accordion Block Content', 'wds-acf-blocks' ),
						'accordion_items' => array(
							'0' => array(
								'accordion_title' => esc_html__( 'Accordion Item Title', 'wds-acf-blocks' ),
								'accordion_text'  => esc_html__( 'Accordion Item Content', 'wds-acf-blocks' ),
							),
						),
					),
				),
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'wds-carousel',
			'title'           => esc_html__( 'Carousel', 'wds-acf-blocks' ),
			'description'     => esc_html__( 'A carousel with a call to action for each slide.', 'wds-acf-blocks' ),
			'render_callback' => 'wds_acf_blocks_acf_block_registration_callback',
			'category'        => 'wds-blocks',
			'icon'            => 'slides',
			'keywords'        => array( 'carousel', 'slider', 'wds' ),
			'mode'            => 'preview',
			'enqueue_assets'  => 'wds_acf_blocks_acf_enqueue_carousel_scripts',
			'align'           => 'wide',
			'supports'        => $supports,
			'example'         => array(
				'attributes' => array(
					'data' => array(),
				),
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'wds-cta',
			'title'           => esc_html__( 'Call To Action', 'wds-acf-blocks' ),
			'description'     => esc_html__( 'A call to action block.', 'wds-acf-blocks' ),
			'render_callback' => 'wds_acf_blocks_acf_block_registration_callback',
			'category'        => 'wds-blocks',
			'icon'            => 'megaphone',
			'keywords'        => array( 'call to action', 'cta', 'wds' ),
			'mode'            => 'preview',
			'enqueue_assets'  => 'wds_acf_blocks_acf_enqueue_backend_block_styles',
			'align'           => 'wide',
			'supports'        => $supports,
			'example'         => array(
				'attributes' => array(
					'data' => array(
						'title'       => esc_html__( 'Call To Action Title', 'wds-acf-blocks' ),
						'text'        => esc_html__( 'Call To Action Text', 'wds-acf-blocks' ),
						'button_link' => array(
							'title' => esc_html__( 'Learn More', 'wds-acf-blocks' ),
							'url'   => '#',
						),
					),
				),
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'wds-fifty-fifty',
			'title'           => esc_html__( 'Fifty/Fifty Block', 'wds-acf-blocks' ),
			'description'     => esc_html__( 'A split-content block with text and/or media.', 'wds-acf-blocks' ),
			'render_callback' => 'wds_acf_blocks_acf_block_registration_callback',
			'category'        => 'wds-blocks',
			'icon'            => 'editor-table',
			'keywords'        => array( 'fifty fifty', 'columns', 'wds' ),
			'mode'            => 'preview',
			'enqueue_assets'  => 'wds_acf_blocks_acf_enqueue_backend_block_styles',
			'align'           => 'wide',
			'supports'        => $supports,
			'example'         => array(
				'attributes' => array(
					'data' => array(
						'text_primary' => esc_html__( 'Primary Text content', 'wds-acf-blocks' ),
						'media_right'  => array(
							'url' => plugin_dir_url( dirname( __FILE__ ) ) . '/src/images/placeholder.png',
						),
					),
				),
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'wds-hero',
			'title'           => esc_html__( 'Hero Block', 'wds-acf-blocks' ),
			'description'     => esc_html__( 'A hero with an optional call to action.', 'wds-acf-blocks' ),
			'render_callback' => 'wds_acf_blocks_acf_block_registration_callback',
			'category'        => 'wds-blocks',
			'icon'            => 'slides',
			'keywords'        => array( 'hero', 'wds' ),
			'mode'            => 'preview',
			'enqueue_assets'  => 'wds_acf_blocks_acf_enqueue_backend_block_styles',
			'align'           => 'wide',
			'supports'        => $supports,
			'example'         => array(
				'attributes' => array(
					'data' => array(
						'title'              => esc_html__( 'Call To Action Title', 'wds-acf-blocks' ),
						'text'               => esc_html__( 'Call To Action Text', 'wds-acf-blocks' ),
						'button_link'        => array(
							'title' => esc_html__( 'Learn More', 'wds-acf-blocks' ),
							'url'   => '#',
						),
						'background_options' => array(
							'background_type'  => 'color',
							'background_color' => array(
								'color_picker' => 'blue',
							),
						),
						'display_options'    => array(
							'font_color' => array(
								'color_picker' => 'gallery',
							),
						),
					),
				),
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'wds-recent-posts',
			'title'           => esc_html__( 'Recent Posts Block', 'wds-acf-blocks' ),
			'description'     => esc_html__( 'A set of recent posts displayed by category and/or tag.', 'wds-acf-blocks' ),
			'render_callback' => 'wds_acf_blocks_acf_block_registration_callback',
			'category'        => 'wds-blocks',
			'icon'            => 'admin-page',
			'keywords'        => array( 'recent posts', 'posts', 'wds' ),
			'mode'            => 'preview',
			'enqueue_assets'  => 'wds_acf_blocks_acf_enqueue_backend_block_styles',
			'align'           => 'wide',
			'supports'        => $supports,
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'wds-related-posts',
			'title'           => esc_html__( 'Related Posts Block', 'wds-acf-blocks' ),
			'description'     => esc_html__( 'A set of manually selected posts.', 'wds-acf-blocks' ),
			'render_callback' => 'wds_acf_blocks_acf_block_registration_callback',
			'category'        => 'wds-blocks',
			'icon'            => 'admin-page',
			'keywords'        => array( 'related posts', 'posts', 'wds' ),
			'mode'            => 'preview',
			'enqueue_assets'  => 'wds_acf_blocks_acf_enqueue_backend_block_styles',
			'align'           => 'wide',
			'supports'        => $supports,
		)
	);
}
add_action( 'acf/init', 'wds_acf_blocks_acf_init' );

/**
 * Adds a WDS Block category to the Gutenberg category list.
 *
 * @param array  $categories The existing categories.
 * @param object $post The current post.
 * @return array The updated array of categories.
 * @author Corey Collins
 */
function wds_acf_blocks_add_block_categories( $categories, $post ) {

	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'wds-blocks',
				'title' => esc_html__( 'WDS Blocks', 'wds-acf-blocks' ),
			),
		)
	);
}
add_filter( 'block_categories', 'wds_acf_blocks_add_block_categories', 10, 2 );

/**
 * Update Layout Titles with Subfield Image and Text Fields
 *
 * @author WDS
 * @param string $block_title Default Field Title.
 * @param array  $field Field array.
 * @param string $layout Layout type.
 * @param int    $i number.
 *
 * @url https://support.advancedcustomfields.com/forums/topic/flexible-content-blocks-friendlycustom-collapsed-name/
 *
 * @return string new ACF title.
 */
function wds_acf_blocks_acf_flexible_content_layout_title( $block_title, $field, $layout, $i ) {

	// Current ACF field name.
	$current_title = $block_title;

	// Remove layout title from text.
	$block_heading = '';

	// Set an expired var.
	$expired = '';

	// Get other options.
	$other_options = get_sub_field( 'other_options' ) ? get_sub_field( 'other_options' ) : get_field( 'other_options' )['other_options'];

	// Get Background Type.
	$background = get_sub_field( 'background_options' )['background_type']['value'];

	// If there's no background, just move along...
	if ( 'none' !== $background ) {
		$background_repeater = get_sub_field( 'carousel_slides' )[0]['background_options']['background_type']['value'];
		$background_type     = $background ? $background : $background_repeater;

		$type = wds_acf_blocks_return_flexible_content_layout_value( $background_type );

		// Load image from non-repeater sub field background image, if it exists else Load image from repeater sub field background image, if it exists - Hero.
		if ( 'image' === $background_type ) {
			$block_heading .= '<img src="' . esc_url( $type['sizes']['thumbnail'] ) . '" height="30" width="30" class="acf-flexible-title-image" />';
		}

		if ( 'video' === $background_type ) {
			$block_heading .= '<div style="font-size: 30px; height: 26px; width: 30px;" class="dashicons dashicons-format-video acf-flexible-title-image"><span class="screen-reader-text">' . esc_html__( 'Video', 'wds-acf-blocks' ) . '</span></div>';
		}
	}

	// Set default field title. Don't want to lose this.
	$block_heading .= '<strong>' . esc_html( $current_title ) . '</strong>';

	// ACF Flexible Content Title Fields.
	$block_title = get_sub_field( 'title' );
	$headline    = get_sub_field( 'carousel_slides' )[0]['title'];
	$text        = $block_title ? $block_title : $headline;
	$start_date  = $other_options['start_date'];
	$end_date    = $other_options['end_date'];

	// If the block has expired, add "(expired)" to the title.
	if ( wds_acf_blocks_has_block_expired(
			array(
				'start_date' => $start_date,
				'end_date'   => $end_date,
			)
		)
	) {
		$expired .= '<span style="color: red;">&nbsp;(' . esc_html__( 'expired', 'wds-acf-blocks' ) . ')</span>';
	}

	// Load title field text else Load headline text - Hero.
	if ( $text ) {
		$block_heading .= '<span class="acf-flexible-content-headline-title"> - ' . $text . '</span>';
	}

	// Return New Title.
	return $block_heading . $expired;
}
add_filter( 'acf/fields/flexible_content/layout_title/name=content_blocks', 'wds_acf_blocks_acf_flexible_content_layout_title', 10, 4 );

if ( function_exists( 'wds_acf_blocks_acf_flexible_content_layout_title' ) ) {

	/**
	 * Set Admin Styles for Flexible Content Layout Image/Title in wds_acf_blocks_acf_flexible_content_layout_title().
	 *
	 * @author WDS
	 */
	function wds_acf_blocks_flexible_content_layout_title_acf_admin_head() {
	?>
	<style type="text/css">
		.acf-flexible-content .layout .acf-fc-layout-handle {
			display: flex;
			align-items: center;
		}

		.acf-flexible-title-image,
		.acf-flexible-content .layout .acf-fc-layout-order {
			margin-right: 10px;
		}

		.acf-flexible-content-headline-title {
			display: inline-block;
			margin-left: 8px;
		}
	</style>
	<?php
	}
	add_action( 'acf/input/admin_head', 'wds_acf_blocks_flexible_content_layout_title_acf_admin_head' );
}

/**
 * Load colors dynamically into select field from wds_acf_blocks_get_theme_colors()
 *
 * @author WDS
 * @param array $field field options.
 * @return array new field choices.
 *
 * @author Corey Colins <corey@webdevstudios.com>
 */
function wds_acf_blocks_acf_load_color_picker_field_choices( $field ) {

	// Reset choices.
	$field['choices'] = array();

	// Grab our colors array.
	$colors = wds_acf_blocks_get_theme_colors();

	// Loop through colors.
	foreach ( $colors as $key => $color ) {

		// Create display markup.
		$color_output = '<div style="display: flex; align-items: center;"><span style="background-color:' . esc_attr( $color ) . '; border: 1px solid #ccc;display:inline-block; height: 15px; margin-right: 10px; width: 15px;"></span>' . esc_html( $key ) . '</div>';

		// Set values.
		$field['choices'][ sanitize_title( $key ) ] = $color_output;
	}

	// Return the field.
	return $field;
}
add_filter( 'acf/load_field/name=color_picker', 'wds_acf_blocks_acf_load_color_picker_field_choices' );

/**
 * Filters WYSIWYG content with the_content filter.
 *
 * @param string $content content dump from WYSIWYG.
 * @return mixed $content.
 * @author jomurgel
 */
function wds_acf_blocks_get_the_content( $content ) {

	// Bail if no content exists.
	if ( empty( $content ) ) {
		return;
	}
	// Returns the content.
	return $content;
}
add_filter( 'the_content', 'wds_acf_blocks_get_the_content', 20 );
