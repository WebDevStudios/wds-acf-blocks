# Scripts

[Documentation Navigation](#documentation-navigation)

## Block Level Scripts

Each block has it's own `script.js` file that is enqueued in the block's `block.json` file. This file is where you would put any JavaScript that is specific to that block.

## Block Level Styles

Each block has it's own `styles.scss` file that is enqueued in the block's `block.json` file. This file is where you would put any styles that are specific to that block.

## Global Scripts

`webpack.global.js` is responsible for compiling all of the global scripts. It essentially takes all the files in `assets/global-scripts` and `assets/global-styles` and compiles them into `build/global-scripts.js` and `build/global-styles.css` respectively.

They are then built into the dist folder where we'll have admin and frontend scripts and styles. All the global scripts and styles should be handled by these files.

## WP CLI SCRIPT

WP CLI command will copy all the files in the `wpcli/blockstarter` folder to the block folder of the plugin. It will rename all the placeholder text with your block name and namespace.

## Documentation Navigation

-   [Overview](Home.md)
-   [Philosophy](Philosophy.md)
-   [Functions](Functions.md)
-   [Blocks](Blocks.md)
-   [Modules](Modules.md)
-   [Elements](Elements.md)
-   [Scripts](Scripts.md)
-   [WP-CLI](WP-CLI.md)
