# Scripts

[Documentation Navigation](#documentation-navigation)

## Block Level Scripts

Each block has it's own `script.js` and `editor.js` files that are enqueued in the block's `block.json` file. These files are where you would put any JavaScript for the front-end (`script.js`) or back-end (`editor.js`) that are specific to that block. The `script.js` loads in both the front and back-end of WordPress while the `editor.js` only loads in the back-end.

## Block Level Styles

Each block has it's own `style.scss` and `editor.scss` files that are enqueued in the block's `block.json` file. These files are where you would put any styles for the front-end(`style.scss`) or the back-end (`editor.scss`) that are specific to that block. The `style.scss` loads in both the front and back-end of WordPress while the `editor.scss` only loads in the back-end.

## Global Scripts

`webpack.global.js` is responsible for compiling all of the global scripts. It essentially takes all the files in `assets/global-scripts` and `assets/global-styles` and compiles them into `dist/global-scripts.js` and `dist/global-styles.css` respectively.

They are then built into the dist folder where we'll have admin and frontend scripts and styles. All the global scripts and styles should be handled by these files.

## WP CLI SCRIPT

WP CLI command will copy all the files in the `wpcli/block-starter` folder to the block folder of the plugin. It will rename all the placeholder text with your block name and namespace.

## Documentation Navigation

-   [Overview](Home.md)
-   [Philosophy](Philosophy.md)
-   [Functions](Functions.md)
-   [Blocks](Blocks.md)
-   [Modules](Modules.md)
-   [Elements](Elements.md)
-   [Scripts](Scripts.md)
-   [WP-CLI](WP-CLI.md)
