/**
 * File carousel/script.js
 *
 */
import './style.scss';
import Glide from '@glidejs/glide';

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
	new Glide( '.glide' ).mount();
}
