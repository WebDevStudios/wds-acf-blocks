require( 'dotenv' ).config();

//THIS DOES NOT WORK
const fs = require( 'fs' );
const globalThemePreset = fs.existsSync( process.env.activePreset )
	? process.env.activePreset
	: process.env.fallbackPreset;


//THIS WORKS
// const globalThemePreset = '/Users/jennahines/Sites/wds-acf-blocks/app/public/wp-content/themes/wd_s/wds.preset.js';


//THIS WORKS
// const path = require( 'path' );
// global.appRoot = path.resolve( __dirname );
// const globalThemePreset = path.join(
// 	global.appRoot,
// 	'./../../themes/wd_s/wds.preset.js'
// );

console.log(globalThemePreset);

module.exports = {
	plugins: {
		tailwindcss: { config: require( globalThemePreset ) },
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
	globalThemePreset,
};
