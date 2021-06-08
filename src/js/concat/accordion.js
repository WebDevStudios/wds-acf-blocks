/**
 * File accordion.js
 *
 * Deal with ACF Block accordions.
 */

// Make sure everything is loaded first.
if (
	( 'complete' === document.readyState ||
		'loading' !== document.readyState ) &&
	! document.documentElement.doScroll
) {
	wdsAccordion();
} else {
	document.addEventListener( 'DOMContentLoaded', wdsAccordion );
}

/**
 * Accessible Accordion block functionality.
 *
 * @author JC Palmes
 * @since May 25, 2021
 */
function wdsAccordion() {
	const accordionTrigger = document.querySelectorAll( '.accordion-item-toggle' ),
		accordionBody = document.querySelectorAll( '.accordion-item-body' );

	// Open the hash link if one exists.
	openHashLink();

	const accordionsToggle = ( triggers, bodyElements ) => {
		triggers.forEach( ( e ) => {
			e.addEventListener( 'click', () => {
				e.disabled = true;
				setTimeout( () => {
					e.disabled = false;
				}, 500 );
				const eBody = e
					.closest( '.accordion-item' )
					.querySelector( '.accordion-item-body' );
				e.classList.toggle( 'accordion-item-toggle--active' );
				eBody.style.height = `${ eBody.scrollHeight }px`;
				if (
					( '0px' === eBody.style.height ||
						'0px' === window.getComputedStyle( eBody ).height ) &&
					'true' === eBody.getAttribute( 'aria-hidden' )
				) {
					e.setAttribute( 'aria-expanded', 'true' );
					eBody.setAttribute( 'aria-hidden', 'false' );
				} else {
					eBody.style.height = '0';
					e.setAttribute( 'aria-expanded', 'false' );
					eBody.setAttribute( 'aria-hidden', 'true' );
				}
			} );
		} );
		bodyElements.forEach( ( e ) => {
			e.addEventListener( 'transitionend', () => {
				if ( '0px' !== e.style.height ) {
					e.style.height = 'auto';
				}
			} );
		} );
	};

	accordionsToggle( accordionTrigger, accordionBody );
}

/**
 * Checks for a hash link in the URL.
 * If one exists and matches an accordion,
 * opens that accordion item.
 *
 * @author Shannon MacMillan, Corey Collins
 * @since January 31, 2020
 * @return {boolean} Early bail of no hash.
 */
function openHashLink() {
	if ( ! window.location.hash ) {
		return false;
	}

	const hashAccordionItem = document.querySelector( window.location.hash ),
		hashAccordionItemHeader = hashAccordionItem.previousElementSibling,
		hashAccordionItemButton = hashAccordionItemHeader.querySelector(
			'.accordion-item-toggle'
		);

	hashAccordionItemButton.click();
}

// Handles ACF + Goots backend integration.
if ( window.acf ) {
	window.acf.addAction(
		'render_block_preview/type=wds-accordion',
		wdsAccordion
	);
}
