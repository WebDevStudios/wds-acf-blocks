require('dotenv').config();

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
