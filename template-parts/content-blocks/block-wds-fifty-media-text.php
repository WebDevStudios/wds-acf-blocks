<?php
/**
 *  The template used for displaying fifty/fifty media/text.
 *
 * @package _s
 */

// Set up fields.
global $fifty_block, $fifty_alignment, $fifty_classes;
$image_data = get_field( 'media_left' );
$text       = get_field( 'text_primary' );

// Start a <container> with a possible media background.
wds_acf_blocks_display_block_options(
	array(
		'block'     => $fifty_block,
		'container' => 'section', // Any HTML5 container: section, div, etc...
		'class'     => 'content-block fifty-fifty-block fifty-media-text' . esc_attr( $fifty_alignment . $fifty_classes ), // The class of the container.
	)
);
?>
	<div class="display-flex container">

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

		<div class="half">
			<?php echo wds_acf_blocks_get_the_content( $text ); // WPCS XSS OK. ?>
		</div>

	</div>
</section>
