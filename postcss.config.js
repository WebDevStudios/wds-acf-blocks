const fs = require( 'fs' );
require( 'dotenv' ).config();

module.exports = {
	plugins: {
		tailwindcss: {config: fs.existsSync( process.env.activePreset )
			? require( process.env.activePreset )
			: require( process.env.fallbackPreset )
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
