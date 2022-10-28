const { tailwindPreset } = require( '../../postcss.config' );
const directoryFiles = [ `./assets/global-styles/*.scss` ];

module.exports = {
	presets: [ require( tailwindPreset ) ],
	content: directoryFiles,
	theme: {
		extend: {},
	},
	variants: {
		extend: {},
	},
	plugins: [],
};
