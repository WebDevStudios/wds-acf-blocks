<?php
/**
 * Safe check for ACF 6.0.
 *
 * @package abs
 */

namespace WebDevStudios\abs;

/**
 * Checks if porable blocks can be used since it requires acf 6.0.
 *
 * @since ??
 * @author Biplav Subedi <biplav.subedi@webdevstudios.com>
 */
function is_portable() {

	if ( ! function_exists( 'acf' ) || 6 > absint( acf()->version )  ) :
		return false ;
	endif;

	return true;
}
