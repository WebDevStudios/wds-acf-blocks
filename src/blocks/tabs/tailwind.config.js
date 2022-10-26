const blockName = 'tabs';
const fs = require( 'fs' );

const directoryFiles = [
	`./src/blocks/${ blockName }/*.php`,
	`./src/blocks/${ blockName }/*.scss`,
	`./src/blocks/${ blockName }/*.js`,
];

module.exports = {
	presets: [
		fs.existsSync( process.env.activePreset )
			? require( process.env.activePreset )
			: require( process.env.fallbackPreset ),
	],
	content: directoryFiles,
};
