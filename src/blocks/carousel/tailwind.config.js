const { globalThemePreset } = require( '../../../postcss.config' );
const blockName = 'carousel';

const directoryFiles = [
	`./src/blocks/${ blockName }/*.php`,
	`./src/blocks/${ blockName }/*.scss`,
	`./src/blocks/${ blockName }/*.js`,
];

module.exports = {
	presets: [ require( globalThemePreset ) ],
	content: directoryFiles,
};
