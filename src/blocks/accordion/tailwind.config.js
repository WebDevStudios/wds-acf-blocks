const blockName = 'accordion';

const directoryFiles = [
	`./src/blocks/${blockName}/*.php`,
	`./src/blocks/${blockName}/*.scss`,
	`./src/blocks/${blockName}/*.js`
];

module.exports = {
	content: directoryFiles
};
