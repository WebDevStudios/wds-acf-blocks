const fs = require( 'fs' );

const directoryFiles = [ `./assets/editor-styles/*.scss` ];

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
