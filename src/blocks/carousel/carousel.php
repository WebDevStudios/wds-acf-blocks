<?php
/**
 * BLOCK - Renders a Carousel
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package abs
 */

use function WebDevStudios\abs\print_module;
use function WebDevStudios\abs\print_element;
use function WebDevStudios\abs\get_formatted_atts;
use function WebDevStudios\abs\get_acf_fields;
use function WebDevStudios\abs\get_block_classes;

$abs_defaults = [
	'class'               => [ 'wds-block', 'carousel' ],
	'show_arrows'         => true,
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
$abs_block_heading = get_acf_fields( [ 'block_heading' ], $block['id'] );
$abs_block_content = get_acf_fields( [ 'block_content' ], $block['id'] );
$abs_heros         = get_acf_fields( [ 'hero' ], $block['id'] );
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>
	<figure>
		<img
			src="<?php echo esc_url( get_theme_file_uri( 'build/images/block-previews/carousel-preview.jpg' ) ); ?>"
			alt="<?php esc_html_e( 'Preview of the Carousel Block', 'abs' ); ?>"
		>
	</figure>
<?php elseif ( $abs_heros['hero'] ) : ?>
	<section <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<?php echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $abs_defaults['allowed_innerblocks'] ) ) . '" />'; ?>
		<section class="hero-wrap">
			<div class="glide">
				<div data-glide-el="track" class="glide__track carousel-track">
					<ul class="glide__slides carousel-items">
						<?php
						foreach ( $abs_heros['hero'] as $abs_hero ) :
							echo '<li class="glide__slide carousel-item">';
								print_module(
									'hero',
									$abs_hero
								);
							echo '</li><!-- .carousel-item -->';
						endforeach;
						?>
					</ul><!-- .carousel-items -->
				</div><!-- .carousel-track -->
				<div class="glide__arrows" data-glide-el="controls">
					<button class="glide__arrow glide__arrow--left" data-glide-dir="<">prev</button>
					<button class="glide__arrow glide__arrow--right" data-glide-dir=">">next</button>
				</div><!-- .glide__arrows -->
			</div><!-- .glide -->
		</section><!-- .hero-wrap -->
	</section>
<?php endif; ?>
