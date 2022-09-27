/**
 * File tabs/script.js
 *
 */
import './style.scss';

// Make sure everything is loaded first.
if (
	( 'complete' === document.readyState ||
		'loading' !== document.readyState ) &&
	! document.documentElement.doScroll
) {
	wdsTabs();
} else {
	document.addEventListener( 'DOMContentLoaded', wdsTabs );
}

/**
 * Start Tabs function
 *
 */
function wdsTabs() {
	const tabList = document.querySelector( '.wds-module-tabs nav' );
	const tabs = document.querySelectorAll( '.wds-module-tabs .tab-title' );

	// Add a click event handler to each tab
	tabs.forEach( ( tab ) => {
		tab.addEventListener( 'click', changeTabs );
	} );

	// Enable arrow navigation between tabs in the tab list
	let tabFocus = 0;

	tabList.addEventListener( 'keydown', ( e ) => {
		// Move right
		if ( 39 === e.keyCode || 37 === e.keyCode ) {
			tabs[ tabFocus ].setAttribute( 'tabindex', -1 );

			if ( 39 === e.keyCode ) {
				tabFocus++;
				// If we're at the end, go to the start
				if ( tabFocus >= tabs.length ) {
					tabFocus = 0;
				}

				// Move left
			} else if ( 37 === e.keyCode ) {
				tabFocus--;
				// If we're at the start, move to the end
				if ( tabFocus < 0 ) {
					tabFocus = tabs.length - 1;
				}
			}

			tabs[ tabFocus ].setAttribute( 'tabindex', 0 );
			tabs[ tabFocus ].focus();
		}
	} );

	function changeTabs( e ) {
		const target = e.target;
		const parent = target.parentNode;
		const grandparent = parent.parentNode;

		// Remove all current selected tabs
		parent
			.querySelectorAll( '[aria-selected="true"]' )
			.forEach( ( t ) => t.setAttribute( 'aria-selected', false ) );

		// Set this tab as selected
		target.setAttribute( 'aria-selected', true );

		// Hide all tab panels
		grandparent
			.querySelectorAll( '[role="tabpanel"]' )
			.forEach( ( p ) => p.setAttribute( 'hidden', true ) );

		// Show the selected panel
		grandparent.parentNode
			.querySelector( `#${ target.getAttribute( 'aria-controls' ) }` )
			.removeAttribute( 'hidden' );
	}
}
