const fs = require( 'fs' );

const directoryFiles = [ `./assets/global-styles/*.scss` ];

module.exports = {
	presets: [
		fs.existsSync( process.env.activePreset )
			? require( process.env.activePreset )
			: require( process.env.fallbackPreset ),
	],
	content: directoryFiles,
	theme: {
		extend: {},
	},
	variants: {
		extend: {},
	},
	plugins: [],
};
