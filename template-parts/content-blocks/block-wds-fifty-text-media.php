<?php
/**
 *  The template used for displaying fifty/fifty text/media.
 *
 * @package _s
 */

// Set up fields.
global $fifty_block, $fifty_alignment, $fifty_classes;
$image_data = get_field( 'media_right' );
$text       = get_field( 'text_primary' );

// Start a <container> with a possible media background.
wds_acf_gutenberg_display_block_options(
	array(
		'block'     => $fifty_block,
		'container' => 'section', // Any HTML5 container: section, div, etc...
		'class'     => 'content-block grid-container fifty-fifty-block fifty-text-media' . esc_attr( $fifty_alignment . $fifty_classes ), // Container class.
	)
);
?>
	<div class="display-flex container">

		<div class="half">
			<?php echo wds_acf_gutenberg_get_the_content( $text ); // WPCS: XSS OK. ?>
		</div>

		<div class="half">
			<?php
			if ( $image_data ) :
				if ( ! $image_data['ID'] ) :
					echo '<img src="' . esc_url( $image_data['url'] ) . '" class="fifty-image" />';
				else :
					echo wp_get_attachment_image( $image_data['ID'], 'full', false, array( 'class' => 'fifty-image' ) );
				endif;
			endif;
			?>
		</div>

	</div>
</section>
