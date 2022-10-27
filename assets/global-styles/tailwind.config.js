
const directoryFiles = [ `./assets/global-styles/*.scss` ];

module.exports = {
	presets: [ require('../../../../../themes/wd_s/tailwind.config.js')],
	content: directoryFiles,
	theme: {
		extend: {},
	},
	variants: {
		extend: {},
	},
	plugins: [],
};
