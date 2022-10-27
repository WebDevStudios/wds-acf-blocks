const blockName = 'side-by-side';

const directoryFiles = [
	`./src/blocks/${ blockName }/*.php`,
	`./src/blocks/${ blockName }/*.scss`,
	`./src/blocks/${ blockName }/*.js`,
];
console.log(global.themePreset)

module.exports = {
	presets: [require('../../../../../themes/wd_s/tailwind.config.js')],
	content: directoryFiles,
};
