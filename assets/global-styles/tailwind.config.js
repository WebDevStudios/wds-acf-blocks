const fs = require( 'fs' );

const directoryFiles = [ `./assets/global-styles/*.scss` ];

module.exports = {
	presets: [
		fs.existsSync( global.themePreset )
			? require( global.themePreset )
			: '',
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
