const blockName = 'logo-grid';

const directoryFiles = [
	`./src/blocks/${blockName}/*.php`,
	`./src/blocks/${blockName}/*.scss`,
	`./src/blocks/${blockName}/*.js`
];

module.exports = {
	content: directoryFiles
};
