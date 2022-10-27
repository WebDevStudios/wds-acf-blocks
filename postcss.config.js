module.exports = {
	plugins: {
		tailwindcss: { config: require( './../../themes/wd_s/wds.preset.js' ) },
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
