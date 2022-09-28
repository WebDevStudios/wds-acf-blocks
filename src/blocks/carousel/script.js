/**
 * File carousel/script.js
 *
 */
import './style.scss';
import Swiper, { Navigation, Pagination, A11y, Keyboard, Lazy } from 'swiper';

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
	new Swiper( '.swiper', {
		modules: [ Navigation, Pagination, A11y, Keyboard, Lazy ],
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		},
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
		loop: true,
		a11y: true,
		preloadImages: false,
		lazy: true,
		keyboard: true,
	} );
}
