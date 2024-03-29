const fs = require( 'fs' );
const path = require( 'path' );
const request = require( 'request' );
const themeUrl =
	'https://raw.githubusercontent.com/WebDevStudios/wd_s/main/wds.preset.js';
const downloadPath = path.join(
	path.resolve( __dirname ),
	'./fallbackPreset.js'
);

const envPath = path.join( path.resolve( __dirname ), './env.json' );

let { tailwindPreset } = fs.existsSync( envPath )
	? require( './env.json' )
	: false;

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
