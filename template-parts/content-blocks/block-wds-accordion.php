<?php
/**
 * The template used for displaying an accordion block.
 *
 * @package _s
 * @since June 09, 2021
 */

// Set up fields.
$block_title     = get_field( 'title' );
$text            = get_field( 'text' );
$accordion_items = get_field( 'accordion_items' );
$row_index       = get_row_index();
$alignment       = wds_acf_blocks_get_block_alignment( $block );
$classes         = wds_acf_blocks_get_block_classes( $block );

// Start a <container> with possible block options.
wds_acf_blocks_display_block_options(
	array(
		'block'     => $block,
		'container' => 'section', // Any HTML5 container: section, div, etc...
		'class'     => 'content-block accordion-block' . esc_attr( $alignment . $classes ), // Container class.
	)
);

?>
	<div class="container">
		<?php if ( $block_title ) : ?>
			<h2 class="block-title"><?php echo esc_html( $block_title ); ?></h2>
		<?php endif; ?>

		<?php if ( $text ) : ?>
			<?php echo wds_acf_blocks_get_the_content( $text ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php endif; ?>

		<?php if ( $accordion_items ) : ?>
			<?php $count = 0; ?>
			<div class="accordion" aria-label="<?php esc_attr_e( 'Accordion Content Block', 'wds-acf-blocks' ); ?>">
				<?php foreach ( $accordion_items as $accordion_item ) : ?>
					<?php
					$count++;
					$item_title      = get_sub_field( 'accordion_title' );
					$item_content    = get_sub_field( 'accordion_text' );
					$item_content_id = 'accordion-' . intval( $row_index ) . '-item-' . intval( $count );
					?>
					<div class="accordion-item">
						<div class="accordion-item-header">
							<h3 class="accordion-item-title"><?php echo esc_html( $accordion_item['accordion_title'] ); ?>
								<button class="accordion-item-toggle" aria-expanded="false" aria-controls="<?php echo esc_attr( $item_content_id ); ?>">
									<span class="screen-reader-text"><?php echo sprintf( esc_html( 'Toggle %s', 'wds-acf-blocks' ), esc_html( $accordion_item['accordion_title'] ) ); ?></span>
									<span class="accordion-item-toggle-icon" aria-hidden="true">+</span>
								</button><!-- .accordion-item-toggle -->
							</h3><!-- .accordion-item-title -->
						</div><!-- .accordion-item-header -->
						<div id="<?php echo esc_attr( $item_content_id ); ?>" class="accordion-item-body" aria-hidden="true">
							<div class="accordion-item-content">
								<?php echo wds_acf_blocks_get_the_content( $accordion_item['accordion_text'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</div><!-- .accordion-item-content -->
						</div><!-- .accordion-item-body -->
					</div><!-- .accordion-item -->
				<?php endforeach; ?>
			</div><!-- .accordion -->
		<?php endif; ?>
	</div><!-- .container -->
</section><!-- .accordion-block -->
