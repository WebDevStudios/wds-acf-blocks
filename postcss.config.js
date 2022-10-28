require( 'dotenv' ).config();

const path = require( 'path' );
// global.appRoot = path.resolve( __dirname );
// const globalThemePreset = path.join(
// 	global.appRoot,
// 	'./../../themes/wd_s/wds.preset.js'
// );
const globalThemePreset = fs.existsSync( process.env.activePreset )
	? require( process.env.activePreset )
	: require( process.env.fallbackPreset );

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
