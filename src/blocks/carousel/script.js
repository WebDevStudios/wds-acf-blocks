/**
 * File carousel/script.js
 *
 */
import './style.scss';

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
	const carouselItems = document.querySelectorAll(
			'.wds-module-carousel .carousel-item'
		),
		carouselTriggers = document.querySelectorAll(
			'.wds-module-carousel .carousel-title'
		),
		showClass = 'carousel-item-is-open';

	carouselItems.forEach( ( item ) => {
		const isOpen = item.classList.contains( showClass );
		const trigger = item.querySelector( '.carousel-title' );
		trigger.setAttribute( 'aria-expanded', isOpen );
	} );

	carouselTriggers.forEach( ( trigger ) => {
		trigger.addEventListener( 'click', toggleCarousel );
	} );

	/**
	 * Open or close the carousel.
	 *
	 * @param {Object} event the triggered event.
	 */
	function toggleCarousel( event ) {
		const target = event.target,
			carouselItem = target.closest( '.carousel-item' ),
			isOpen = target.getAttribute( 'aria-expanded' ) === 'true',
			ariaValue = isOpen ? 'false' : 'true';

		if ( ! isOpen ) {
			carouselItem.classList.add( showClass );
		} else {
			carouselItem.classList.remove( showClass );
		}

		target.setAttribute( 'aria-expanded', ariaValue );
	}
}
