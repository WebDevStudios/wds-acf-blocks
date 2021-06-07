<?php
/**
 * The template used for displaying a caroursel.
 *
 * @package _s
 */

$carousel     = get_field( 'carousel_slides' );
$alignment    = wds_acf_blocks_get_block_alignment( $block );
$classes      = wds_acf_blocks_get_block_classes( $block );
$classnames[] = 'content-block carousel-block glider-contain' . $alignment . $classes;
$classnames[] = get_sub_field( 'block_width' );

// Start repeater markup...
if ( have_rows( 'carousel_slides' ) ) :
	echo '<section class="' . esc_attr( implode( ' ', array_filter( $classnames ) ) ) . '">';
		echo '<div class="glider">';

			// Loop through slide slides.
			while ( have_rows( 'carousel_slides' ) ) :
				the_row();

				// Set up fields.
				$color         = get_sub_field( 'font_color' );
				$block_title   = get_sub_field( 'title' );
				$text          = get_sub_field( 'text' );
				$button        = get_sub_field( 'button_link' );
				$other_options = get_sub_field( 'other_options' ) ? get_sub_field( 'other_options' ) : get_field( 'other_options' )['other_options'];
				$classname     = $color && wds_acf_blocks_has_array_key( 'color_picker', $color ) ? 'has-font-color color-' . esc_attr( $color['color_picker'] ) : '';

				// If the block has expired, then bail!
				if ( wds_acf_blocks_has_block_expired(
					array(
						'start_date' => $other_options['start_date'],
						'end_date'   => $other_options['end_date'],
					)
				) ) {
					continue;
				}

				// Start a <container> with possible block options.
				wds_acf_blocks_display_block_options(
					array(
						'block'     => $block,
						'container' => 'div', // Any HTML5 container: section, div, etc...
						'class'     => 'slide glider-slide', // Container class.
						'id'        => esc_attr( 'carousel-' . get_row_index() ),
					)
				);
				?>
					<div class="slide-content container <?php echo esc_attr( $classname ); ?>">

						<?php if ( $block_title ) : ?>
							<h2 class="slide-title"><?php echo esc_html( $block_title ); ?></h2>
						<?php endif; ?>

						<?php if ( $text ) : ?>
							<p class="slide-description"><?php echo esc_html( $text ); ?></p>
						<?php endif; ?>

						<?php
						wds_acf_blocks_display_link(
							array(
								'button' => true,
								'class'  => 'button-slide',
								'link'   => $button,
							)
						);
						?>

					</div><!-- .slide-content -->
				</div><!-- .slide -->
		<?php
			endwhile;
		echo '</div><!-- .glider -->';
		echo wds_acf_blocks_acf_gutenberg_display_carousel_control( $carousel ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo '</section><!-- .carousel-block -->';
endif;
