const path = require( 'path' );
global.appRoot = path.resolve( __dirname );
globalThemePreset = path.join(
	global.appRoot,
	'./../../themes/wd_s/wds.preset.js'
);

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
	globalThemePreset
};
