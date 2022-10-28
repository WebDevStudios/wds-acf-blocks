// Require dotenv.
require( 'dotenv' ).config();

const fs = require( 'fs' );
const path = require( 'path' );
const request = require( 'request' );
const themeUrl =
	'https://raw.githubusercontent.com/WebDevStudios/wd_s/main/wds.preset.js';
const downloadPath = 'fallbackPreset.js';

if ( ! fs.existsSync( 'fallbackPreset.js' ) ) {
	request( themeUrl )
		.pipe( fs.createWriteStream( downloadPath ) )
		.on( 'close', function () {} );
}

// set presetContents
let envVars =
	'activePrest="' +
	path.join( __dirname, './../../themes/wd_s/wds.preset.js"' + '\r\n' );

envVars +=
	'fallbackPreset="' +
	path.join( __dirname, './fallbackPreset.js"' + '\r\n' );

fs.writeFileSync( '.env', envVars, function ( err ) {
	if ( err ) {
		return err;
	}
} );
