<?php
/**
 * BLOCK - Renders a Carousel
 *
 * @link https://developer.wordpress.org/block-editor/
 *
 * @package abs
 */

use function WebDevStudios\abs\print_module;
use function WebDevStudios\abs\print_element;
use function WebDevStudios\abs\get_formatted_atts;
use function WebDevStudios\abs\get_acf_fields;
use function WebDevStudios\abs\get_block_classes;

$abs_defaults = [
	'class'               => [ 'wds-block', '.wds-block-carousel' ],
	'show_arrows'         => true,
	'show_pagination'     => true,
	'allowed_innerblocks' => [ 'core/heading', 'core/paragraph' ],
	'id'                  => ! empty( $block['anchor'] ) ? $block['anchor'] : '',
];


// Get custom classes for the block and/or for block colors.
$abs_block_classes = [];
$abs_block_classes = get_block_classes( $block );

if ( ! empty( $abs_block_classes ) ) :
	$abs_defaults['class'] = array_merge( $abs_defaults['class'], $abs_block_classes );
endif;

// Set up element attributes.
$abs_atts = get_formatted_atts( [ 'class', 'id' ], $abs_defaults );

// Pull in the fields from ACF.
$abs_carousels = get_acf_fields( [ 'overlay', 'slides' ], $block['id'] );
?>

<?php
if ( ! empty( $block['data']['_is_preview'] ) ) :
	?>
	<figure>
		<img
			src="<?php echo esc_url( get_theme_file_uri( 'build/images/block-previews/carousel-preview.jpg' ) ); ?>"
			alt="<?php esc_html_e( 'Preview of the Carousel Block', 'abs' ); ?>"
		>
	</figure>
	<?php
elseif ( $abs_carousels['slides'] ) :
	?>
	<section <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<?php echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $abs_defaults['allowed_innerblocks'] ) ) . '" />'; ?>
		<section class="carousel-wrap">
			<div class="swiper">
				<ul class="swiper-wrapper carousel-items">
					<?php
					foreach ( $abs_carousels['slides'] as $abs_slide ) :
						echo '<li class="swiper-slide carousel-item">';

							$abs_slide['class']   = $abs_block_classes;
							$abs_slide['overlay'] = $abs_carousels['overlay'];

							print_module(
								'carousel-slide',
								$abs_slide
							);

						echo '</li><!-- .carousel-item -->';
					endforeach;
					?>
				</ul><!-- .carousel-items -->

				<?php
				if ( $abs_defaults['show_arrows'] ) :
					print_element(
						'button',
						[
							'class' => [ 'carousel-button swiper-button-prev' ],
							'aria'  => [
								'label' => 'Previous Slide',
							],
							'icon'  => [
								'icon'   => 'chevron-left',
								'height' => '50px',
								'width'  => '50px',
							],
						]
					);

					print_element(
						'button',
						[
							'class' => [ 'carousel-button swiper-button-next' ],
							'aria'  => [
								'label' => 'Next Slide',
							],
							'icon'  => [
								'icon'   => 'chevron-right',
								'height' => '50px',
								'width'  => '50px',
							],
						]
					);

				endif;
				?>

				<?php if ( $abs_defaults['show_pagination'] ) : ?>
					<div class="swiper-pagination"></div>
				<?php endif; ?>

			</div><!-- .swiper -->
		</section><!-- .carousel-wrap -->
	</section>
<?php endif; ?>
