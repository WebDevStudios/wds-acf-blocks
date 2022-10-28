const fs = require( 'fs' );
const path = require( 'path' );
const request = require( 'request' );
const themeUrl =
	'https://raw.githubusercontent.com/WebDevStudios/wd_s/main/wds.preset.js';
const downloadPath = path.join( path.resolve( __dirname ), './fallbackPreset.js' );

let { tailwindPreset } = require( './env.json' );

if ( ! fs.existsSync( tailwindPreset ) ) {
	if ( ! fs.existsSync( downloadPath ) ) {
		request( themeUrl )
			.pipe( fs.createWriteStream( downloadPath ) )
			.on( 'close', function () {} );
	}
	tailwindPreset = downloadPath;
}

module.exports = {
	plugins: {
		tailwindcss: { config: require( tailwindPreset ) },
		autoprefixer: { grid: true },
		...( process.env.NODE_ENV === 'production'
			? {
					cssnano: {
						preset: [
							'default',
							{
								discardComments: {
									removeAll: true,
								},
							},
						],
					},
			  }
			: {} ),
	},
	tailwindPreset,
};
