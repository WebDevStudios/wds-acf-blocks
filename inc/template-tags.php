<?php
/**
 * Template tags and helper functions.
 *
 * @author Corey Collins
 * @since 1.0
 * @package wds-acf-blocks
 */

/**
 * Display a card.
 *
 * @author WDS
 * @param array $args Card defaults.
 * @since 1.0
 */
function wds_acf_blocks_display_card( $args = array() ) {

	// Setup defaults.
	$defaults = array(
		'title' => '',
		'image' => '',
		'text'  => '',
		'url'   => '',
		'class' => '',
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );
	?>
	<div class="<?php echo esc_attr( $args['class'] ); ?> card">

		<a href="<?php echo esc_url( $args['url'] ); ?>" tabindex="-1">
			<?php if ( $args['image'] ) : ?>
				<?php echo wp_kses_post( $args['image'] ); ?>
			<?php else : ?>
				<img
					src="<?php echo esc_url( plugin_dir_url( dirname( __FILE__ ) ) ); ?>/src/images/placeholder.png"
					class="card-image"
					loading="lazy"
					<?php /* translators: Post title */ ?>
					alt="<?php echo sprintf( esc_attr__( 'Featured image for %s', 'wds-acf-blocks' ), esc_attr( $args['title'] ) ); ?>"
					>
			<?php endif; ?>
		</a>

		<div class="card-section">

		<?php if ( $args['title'] ) : ?>
			<h3 class="card-title"><a href="<?php echo esc_url( $args['url'] ); ?>"><?php echo esc_html( $args['title'] ); ?></a></h3>
		<?php endif; ?>

		<?php if ( $args['text'] ) : ?>
			<p class="card-text"><?php echo esc_html( $args['text'] ); ?></p>
		<?php endif; ?>

		<?php if ( $args['url'] ) : ?>
			<a class="button button-card" href="<?php echo esc_url( $args['url'] ); ?>"><?php esc_html_e( 'Read More', 'wds-acf-blocks' ); ?></a>
		<?php endif; ?>

		</div><!-- .card-section -->
	</div><!-- .card -->
	<?php
}

/**
 * Limit the excerpt length.
 *
 * @param array $args Parameters include length and more.
 *
 * @author WDS
 * @return string
 * @since 1.0
 */
function wds_acf_blocks_get_the_excerpt( $args = array() ) {

	// Set defaults.
	$defaults = array(
		'length' => 20,
		'more'   => '...',
		'post'   => '',
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Trim the excerpt.
	return wp_trim_words( get_the_excerpt( $args['post'] ), absint( $args['length'] ), esc_html( $args['more'] ) );
}

/**
 * Get the theme colors for this project. Set these first in the Sass partial then migrate them over here.
 *
 * @author WDS
 * @return array The array of our color names and hex values.
 * @author Corey Collins
 * @since 1.0
 */
function wds_acf_blocks_get_theme_colors() {
	return array(
		esc_html__( 'Alto', 'wds-acf-blocks' )           => '#ddd',
		esc_html__( 'Black', 'wds-acf-blocks' )          => '#000',
		esc_html__( 'Blue', 'wds-acf-blocks' )           => '#21759b',
		esc_html__( 'Cod Gray', 'wds-acf-blocks' )       => '#111',
		esc_html__( 'Dove Gray', 'wds-acf-blocks' )      => '#666',
		esc_html__( 'Gallery', 'wds-acf-blocks' )        => '#eee',
		esc_html__( 'Gray', 'wds-acf-blocks' )           => '#808080',
		esc_html__( 'Gray Alt', 'wds-acf-blocks' )       => '#929292',
		esc_html__( 'Light Yellow', 'wds-acf-blocks' )   => '#fff9c0',
		esc_html__( 'Mineshaft', 'wds-acf-blocks' )      => '#333',
		esc_html__( 'Silver', 'wds-acf-blocks' )         => '#ccc',
		esc_html__( 'Silver Chalice', 'wds-acf-blocks' ) => '#aaa',
		esc_html__( 'White', 'wds-acf-blocks' )          => '#fff',
		esc_html__( 'Whitesmoke', 'wds-acf-blocks' )     => '#f1f1f1',
	);
}

/**
 * Adds h1 or h2 heading for hero based on location.
 *
 * @author WDS
 * @param string $block_title acf value.
 * @author jomurgel <jo@webdevstudios.com>
 * @return void
 * @since 1.0
 */
function wds_acf_blocks_display_hero_heading( $block_title ) {

	// Bail if our title is empty.
	if ( empty( $block_title ) ) {
		return;
	}

	// Set hero title to h1 if it's the first block not on the homepage.
	$index   = get_row_index();
	$heading = 1 === $index && ! ( is_front_page() && is_home() ) ? 'h1' : 'h2';

	echo sprintf( '<%1$s class="hero-title">%2$s</%1$s>', esc_attr( $heading ), esc_html( $block_title ) );
}

/**
 * Echo link function
 *
 * @param array $args defaults args - link array and whether or not to append button class.
 * @author jomurgel <jo@webdevstudios.com>
 * @since 1.0
 */
function wds_acf_blocks_display_link( $args = array() ) {
	echo wds_acf_blocks_get_link( $args ); // WPCS: XSS Ok.
}

/**
 * Get link markup from button/link array.
 *
 * @param array $args defaults args - link array and whether or not to append button class.
 * @author jomurgel <jo@webdevstudios.com>
 * @since 1.0
 *
 * @return string button markup.
 */
function wds_acf_blocks_get_link( $args = array() ) {

	// Defaults.
	$defaults = array(
		'button' => false, // display as button?
		'class'  => '',
		'link'   => get_field( 'button_link' ),
	);

	// Parse those args.
	$args = wp_parse_args( $args, $defaults );

	// Make args pretty readable and default.
	$button_array = $args['link'] ?: $defaults['link'];

	// Start output buffer.
	ob_start();

	if ( ! is_array( $button_array ) ) {
		ob_get_clean();
		return;
	}

	// Append button class if button exists.
	$classes = $args['button'] ? ' button' : '';

	// Append class.
	$classes .= ' ' . $args['class'];

	// Get title else default to "Read More".
	$title = wds_acf_blocks_has_array_key( 'title', $button_array ) ? $button_array['title'] : esc_html__( 'Read More', 'wds-acf-blocks' );

	// Get url.
	$url = wds_acf_blocks_has_array_key( 'url', $button_array ) ? $button_array['url'] : '';

	// Get target, else default internal.
	$target = wds_acf_blocks_has_array_key( 'target', $button_array ) ? $button_array['target'] : '_self';
	?>

	<a href="<?php echo esc_url( $url ); ?>" class="<?php echo esc_attr( $classes ); ?>" target="<?php echo esc_attr( $target ); ?>"><?php echo esc_html( $title ); ?></a>

	<?php
	// Return output buffer value.
	return ob_get_clean();
}

/**
 * Return bool for button text.
 *
 * @param [string] $key link array key.
 * @param [array]  $array link array.
 * @author jomurgel <jo@webdevstudios.com>
 * @since 1.0
 *
 * @return bool
 */
function wds_acf_blocks_has_array_key( $key, $array = array() ) {

	if ( ! is_array( $array ) || ( ! $array || ! $key ) ) {
		return false;
	}

	return is_array( $array ) && array_key_exists( $key, $array ) && ! empty( $array[ $key ] );
}

/**
 * Return flexible content field value by type
 *
 * @param string $type field type.
 * @author WDS
 * @return string field value.
 * @since 1.0
 */
function wds_acf_blocks_return_flexible_content_layout_value( $type ) {

	if ( empty( $type ) ) {
		return;
	}

	$background_type          = get_sub_field( 'background_options' )[ "background_{$type}" ];
	$background_type_repeater = get_sub_field( 'carousel_slides' )[0]['background_options'][ "background_{$type}" ];

	return $background_type ? $background_type : $background_type_repeater;
}

/**
 * Returns the alignment set for a content block.
 *
 * @param array $block The block settings.
 * @return string The class, if one is set.
 * @author Corey Collins
 * @since 1.0
 */
function wds_acf_blocks_get_block_alignment( $block ) {

	if ( ! $block ) {
		return;
	}

	return ! empty( $block['align'] ) ? ' align' . esc_attr( $block['align'] ) : 'alignwide';
}

/**
 * Returns the class names set for a content block.
 *
 * @param array $block The block settings.
 * @return string The class, if one is set.
 * @author Corey Collins
 * @since 1.0
 */
function wds_acf_blocks_get_block_classes( $block ) {

	if ( ! $block ) {
		return;
	}

	$classes  = '';
	$classes  = wds_acf_blocks_get_block_expired_class();
	$classes .= ! empty( $block['className'] ) ? ' ' . esc_attr( $block['className'] ) : '';

	return $classes;
}

/**
 * Returns a class to be used for expired blocks.
 *
 * @return string The class, if one is set.
 * @author Corey Collins
 * @since 1.0
 */
function wds_acf_blocks_get_block_expired_class() {

	if ( ! is_admin() ) {
		return;
	}

	$other_options = get_sub_field( 'other_options' );
	$other_options = $other_options ? $other_options : get_field( 'other_options' )['other_options'] ?? [];

	if ( empty( $other_options ) ) {
		return;
	}

	if ( wds_acf_blocks_has_block_expired(
		array(
			'start_date' => $other_options['start_date'],
			'end_date'   => $other_options['end_date'],
		)
	) ) {
		return ' block-expired';
	}
}

/**
 * Displays a message for the user on the backend if a block is expired.
 *
 * @return void Bail if the block isn't expired.
 * @author Corey Collins
 * @since 1.0
 */
function wds_acf_blocks_display_expired_block_message() {

	if ( ! wds_acf_blocks_get_block_expired_class() ) {
		return;
	}

	?>
	<div class="block-expired-message">
		<span class="block-expired-text"><?php esc_html_e( 'Your block has expired. Please change or remove the Start and End dates under Other Options to display your block on the frontend.', 'wds-acf-blocks' ); ?></span>
	</div>
	<?php
}

/**
 * Returns the ID (anchor link field) set for a content block.
 *
 * @param array $block The block settings.
 * @return string The ID, if one is set.
 * @author Corey Collins
 * @since 1.0
 */
function wds_acf_blocks_get_block_id( $block ) {

	if ( ! $block ) {
		return;
	}

	return empty( $block['anchor'] ) ? str_replace( '_', '-', $block['id'] ) : esc_attr( $block['anchor'] );
}

/**
 * Displays a dummy carousel on the backend, since there won't be any rows to load when first adding.
 *
 * @param array $block The block settings.
 * @return void Bail if we have to.
 * @author Corey Collins
 * @since 1.0
 */
function wds_acf_blocks_acf_gutenberg_display_admin_default_carousel( $block ) {

	// Only in the dashboard.
	if ( ! is_admin() ) {
		return;
	}

	// Only if we don't have rows added manually.
	if ( have_rows( 'carousel_slides' ) ) {
		return;
	}

	echo '<div class="content-block carousel-block">';

	for ( $slides = 0; $slides < 2; $slides++ ) :
		?>
		<section class="slide">
			<div class="slide-content container">
				<h2 class="slide-title"><?php esc_html_e( 'Slide Title', 'wds-acf-blocks' ); ?></h2>
				<p class="slide-description"><?php esc_html_e( 'Slide Content', 'wds-acf-blocks' ); ?></p>
			</div>
		</section>
	<?php
	endfor;

	echo '</div>';
}

/**
 * Decide whether or not a block has expired.
 *
 * @author WDS
 * @param array $args start and end dates.
 * @since 1.0
 *
 * @return bool
 */
function wds_acf_blocks_has_block_expired( $args = array() ) {

	// Setup defaults.
	$defaults = array(
		'start_date' => '',
		'end_date'   => '',
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Get (Unix) times and convert to integer.
	$now   = (int) current_time( 'timestamp' );
	$start = (int) $args['start_date'];
	$end   = (int) $args['end_date'];

	// No dates? Cool, they're optional.
	if ( empty( $start ) || empty( $end ) ) {
		return false;
	}

	// The block has started, but hasn't expired yet.
	if ( $start <= $now && $end >= $now ) {
		return false;
	}

	// Yes, the block has expired.
	return true;
}

/**
 * Associate the possible block options with the appropriate section.
 *
 * @author WDS
 * @param  array $args Possible arguments.
 * @since 1.0
 */
function wds_acf_blocks_display_block_options( $args = array() ) {

	// Get block background options.
	$background_options = get_sub_field( 'background_options' ) ? get_sub_field( 'background_options' ) : get_field( 'background_options' )['background_options'];

	// Get block other options.
	$other_options = array();

	// Set our Other Options if we have them. Some blocks may not.
	if ( get_sub_field( 'other_options' ) ) {
		$other_options = get_sub_field( 'other_options' );
	} elseif ( get_field( 'other_options' ) ) {
		$other_options = get_field( 'other_options' )['other_options'];
	}

	// Get block display options.
	$display_options = array(
		'font_color' => '',
	);

	// Set our Display Options if we have them. Some blocks may not.
	if ( get_sub_field( 'display_options' ) ) {
		$display_options = get_sub_field( 'display_options' );
	} elseif ( get_field( 'display_options' ) ) {
		$display_options = get_field( 'display_options' )['display_options'];
	}

	// Get the block ID.
	$block_id = wds_acf_blocks_get_block_id( $args['block'] );

	// Setup defaults.
	$defaults = array(
		'background_type' => $background_options['background_type']['value'],
		'container'       => 'section',
		'class'           => 'content-block',
		'font_color'      => $display_options['font_color'],
		'id'              => $block_id,
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	$background_video_markup = $background_image_markup = '';

	// Show overlay class, if it exists.
	$has_show_overlay = wds_acf_blocks_has_array_key( 'show_overlay', $background_options ) && true === $background_options['show_overlay'] ? ' has-overlay' : '';

	// Only try to get the rest of the settings if the background type is set to anything.
	if ( $args['background_type'] ) {
		if ( 'color' === $args['background_type'] && $background_options['background_color']['color_picker'] ) {
			$background_color = $background_options['background_color']['color_picker'];
			$args['class']   .= ' has-background color-as-background background-' . esc_attr( $background_color );
		}

		if ( 'image' === $args['background_type'] && $background_options['background_image'] ) {
			$background_image = $background_options['background_image'];

			// Construct class.
			$args['class'] .= ' has-background image-as-background' . esc_attr( $has_show_overlay );
			ob_start();
			?>
			<figure class="image-background" aria-hidden="true">
				<?php echo wp_get_attachment_image( $background_image['id'], 'full' ); ?>
			</figure>
			<?php
			$background_image_markup = ob_get_clean();
		}

		if ( 'video' === $args['background_type'] ) {
			$background_video      = $background_options['background_video'];
			$background_video_webm = $background_options['background_video_webm'];
			$background_title      = $background_options['background_video_title'];
			$args['class']        .= ' has-background video-as-background' . esc_attr( $has_show_overlay );
			// Translators: get the title of the video.
			$background_alt = $background_title ? sprintf( esc_attr( 'Video Background of %s', 'wds-acf-blocks' ), esc_attr( $background_options['background_video_title'] ) ) : __( 'Video Background', 'wds-acf-blocks' );

			ob_start();
			?>
				<video class="video-background" autoplay muted loop preload="auto" aria-hidden="true"<?php echo $background_title ? ' title="' . esc_attr( $background_title ) . '"' : ''; ?>>
						<?php if ( $background_video_webm['url'] ) : ?>
						<source src="<?php echo esc_url( $background_video_webm['url'] ); ?>" type="video/webm">
						<?php endif; ?>

						<?php if ( $background_video['url'] ) : ?>
						<source src="<?php echo esc_url( $background_video['url'] ); ?>" type="video/mp4">
						<?php endif; ?>
				</video>
				<button class="video-toggle"><span class="screen-reader-text"><?php esc_html_e( 'Toggle video playback', 'wds-acf-blocks' ); ?></span></button>
			<?php
			$background_video_markup = ob_get_clean();
		}

		if ( 'none' === $args['background_type'] ) {
			$args['class'] .= ' no-background';
		}
	}

	// Set the custom font color.
	if ( isset( $args['font_color']['color_picker'] ) ) {
		$args['class'] .= ' has-font-color color-' . esc_attr( $args['font_color']['color_picker'] );
	}

	// Print our block container with options.
	printf(
		'<%s id="%s" class="%s">',
		esc_attr( $args['container'] ),
		esc_attr( $args['id'] ),
		esc_attr( $args['class'] )
	);

	// If we have a background video, echo our background video markup inside the block container.
	if ( $background_video_markup ) {
		echo $background_video_markup; // WPCS XSS OK.
	}

	// If we have a background image, echo our background image markup inside the block container.
	if ( $background_image_markup ) {
		echo $background_image_markup; // WPCS XSS OK.
	}
}

/**
 * Our callback function – this looks for the block based on its given name.
 * Name accordingly to the file name!
 *
 * @param array $block The block details.
 * @return void Bail if the block has expired.
 * @author Corey Collins
 * @since 1.0
 */
function wds_acf_blocks_acf_block_registration_callback( $block ) {

	// Convert the block name into a handy slug.
	$block_slug = str_replace( 'acf/', '', $block['name'] );

	// Make sure we have fields.
	$start_date = isset( $block['data']['other_options_start_date'] ) ? $block['data']['other_options_start_date'] : '';
	$end_date   = isset( $block['data']['other_options_end_date'] ) ? $block['data']['other_options_end_date'] : '';

	// If the block has expired, then bail! But only on the frontend, so we can still see and edit the block in the backend.
	if ( ! is_admin() && wds_acf_blocks_has_block_expired(
		array(
			'start_date' => strtotime( $start_date, true ),
			'end_date'   => strtotime( $end_date, true ),
		)
	) ) {
		return;
	}

	wds_acf_blocks_display_expired_block_message();

	// Include our template part.
	if ( file_exists( plugin_dir_path( dirname( __FILE__ ) ) . 'template-parts/content-blocks/block-' . $block_slug . '.php' ) ) {
		include plugin_dir_path( dirname( __FILE__ ) ) . 'template-parts/content-blocks/block-' . $block_slug . '.php';
	}
}
