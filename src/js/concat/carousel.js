/**
 * File: carousel.js
 *
 * Carousel functionality in the Carousel ACF Gutenberg block.
 */
import Glider from 'glider-js';

// Make sure everything is loaded first.
if (
	( 'complete' === document.readyState ||
		'loading' !== document.readyState ) &&
	! document.documentElement.doScroll
) {
	wdsCarousel();
} else {
	document.addEventListener( 'DOMContentLoaded', wdsCarousel );
}

/**
  * Kick off our Carousel functions.
  *
  * @since June 7, 2021
  * @author WDS
  */
function wdsCarousel() {
	const wdsCarouselSlides = document.querySelectorAll( '.glider' );

	if ( wdsCarouselSlides.length ) {
		wdsCarouselSlides.forEach( ( carousel ) => {
			new Glider( carousel, {
				slidesToShow: 1,
				slidesToScroll: 1,
				scrollLock: true,
				scrollLockDelay: 250,
				draggable: true,
				dragVelocity: 1,
				rewind: true,
				arrows: {
					prev: '.glider-range-controller .glider-prev',
					next: '.glider-range-controller .glider-next',
				},
			} );

			// Update the slide counter ("n of 2")
			carousel.addEventListener(
				'glider-slide-visible',
				function( event ) {
					event.target.nextElementSibling.querySelector(
						'.index'
					).innerHTML = event.detail.slide + 1;
				}
			);
		} );
	}
}
