/**
 * File carousel/script.js
 *
 */
import './style.scss';
import Glide, { Controls, Keyboard, Swipe } from '@glidejs/glide/dist/glide.modular.esm'

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
 * Start Carousel function
 *
 */
function wdsCarousel() {
	new Glide( '.glide', {
		type: 'carousel',
		classes: {
			swipeable: 'glide-swipeable',
			dragging: 'glide-dragging',
			direction: {
				ltr: 'glide-ltr',
				rtl: 'glide-rtl'
			},
			type: {
				slider: 'glide-slider',
				carousel: 'glide-carousel'
			},
			slide: {
				clone: 'glide-slide-clone',
				active: 'glide-slide-active'
			},
			arrow: {
				disabled: 'glide-arrow-disabled'
			},
			nav: {
				active: 'glide-bullet-active'
			}
		}

	}).mount({ Controls, Keyboard, Swipe });

}
