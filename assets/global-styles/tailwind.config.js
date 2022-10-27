const { globalThemePreset } = require('../../postcss.config');
const directoryFiles = [ `./assets/global-styles/*.scss` ];

module.exports = {
	presets: [ require( globalThemePreset ) ],
	content: directoryFiles,
	theme: {
		extend: {},
	},
	variants: {
		extend: {},
	},
	plugins: [],
};
