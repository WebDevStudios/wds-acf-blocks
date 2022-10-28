require( 'dotenv' ).config();

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
