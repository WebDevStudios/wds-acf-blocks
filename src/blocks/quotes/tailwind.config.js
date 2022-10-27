const blockName = 'quotes';

const directoryFiles = [
	`./src/blocks/${ blockName }/*.php`,
	`./src/blocks/${ blockName }/*.scss`,
	`./src/blocks/${ blockName }/*.js`,
];

module.exports = {
	presets: [ require('../../../../../themes/wd_s/tailwind.config.js')],
	content: directoryFiles,
};
