const path = require( 'path' );
global.themePreset = path.join(
	__dirname,
	'./../../themes/wd_s/wds.preset.js'
);
global.appRoot = path.resolve( __dirname );

module.exports = {
	plugins: {
		'postcss-multiple-tailwind': {
			mode: 'auto',
		},
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
};
