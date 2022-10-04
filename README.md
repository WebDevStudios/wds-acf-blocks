# WDS ACF Blocks

With the advent of Gutenberg in WordPress, Advanced Custom Fields stepped up to help make the process of creating custom blocks easier and faster. This plugin creates a set of custom blocks with basic styles for you to customize in your theme.

[![WebDevStudios. Your Success is Our Mission.](https://webdevstudios.com/wp-content/uploads/2018/04/wds-github-banner.png)](https://webdevstudios.com/contact/)

## 🧱 Available Blocks

This plugin includes the following blocks:

- Accordion
- Carousel

![image](https://i.imgur.com/gOTNnnH.png)

WDS ACF Blocks is bundled with a [Style Lint](https://stylelint.io/), [ESLint](https://eslint.org/), and [PHPCS](https://github.com/squizlabs/PHP_CodeSniffer) linting rulesets – plus, it passes both WCAG 2.1AA and Section 508 standards out of the box.

To better manage ACF Field Groups, the plugin supports [synchronized JSON](https://www.advancedcustomfields.com/resources/synchronized-json/) for Advanced Custom Fields.

👉 Please visit the [WDS ACF Blocks Wiki](https://github.com/WebDevStudios/wds-acf-blocks/wiki/WDS-ACF-Blocks) to learn more about the [features of the blocks](https://github.com/WebDevStudios/wds-acf-blocks/wiki/WDS-ACF-Blocks#block-features) and how you can [create Gutenberg Blocks with ACF](https://github.com/WebDevStudios/wds-acf-blocks/wiki/WDS-ACF-Blocks#creating-gutenberg-blocks-with-acf).

## 📝 Requirements

- [Node LTS](https://nodejs.org/en/)
- [Composer](https://getcomposer.org/)
- [WordPress](https://wordpress.org/)
- [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/pro/)
- [abs](https://github.com/WebDevStudios/abs)

_We highly recommend [NVM](https://github.com/nvm-sh/nvm) so you can easily switch between Node versions._

## Create a Block with WP-CLI
To create a block with WPCLI you can just use this command. 

```bash
wp abs create_portable_block myblock --title="This is myblock" --desc="This block is used for wds." --keywords="myblock" --icon="table-row-before"
```
**Parameters:**
- Title : The title of the block
- Desc : The description of the block
- Keywords : Block keywords
- Icon : The icon of the block

## 💻 Development

### 🚀 Installation

Clone the repository into `wp-content/plugins` of a WordPress website:

```bash
git clone git@github.com:WebDevStudios/wds-acf-blocks.git
```

From the command line, change directories:

```bash
cd wds-acf-blocks
```

Install plugin dependencies and trigger an initial build:

```bash
npm install
```

### 🚦 Workflow

To watch for changes during development, run the following command:

```bash
npm run start
```

![image](https://i.imgur.com/n2FEkhB.jpg)

To build the production version, execute this command:

```bash
npm run build
```
### Building the blocks 
The build directory for the blocks are ignored and not being tracked by git. 
Make sure you push the build folder to your site with the help of CD/CI pipelines or manually because the blocks will not work without the build folder.

### 🛠 Linting Commands

Linting rules for JavaScript and SCSS are defined in [package.json](package.json) from line number 40 to 84.

**Lint JS:**

```bash
npm run lint:js
```

**Lint SCSS:**

```bash
npm run lint:css
```

**Lint PHP:**

The PHPCS ruleset is defined in [.phpcs.xml.dist](.phpcs.xml.dist). To lint PHP via composer, run the following command:

```bash
composer run lint
```

👉 **Important:** This plugin uses [@wordpress/scripts](https://www.npmjs.com/package/@wordpress/scripts) to lint and compile JavaScript and SCSS.

## ✏️ Editing an ACF Block in Gutenberg

To edit an ACF block in Gutenberg, you need to access the settings. Please follow these three simple steps to access the block settings:

### → Step #1

Go to the WordPress admin and open the _add new post_ or _edit post_ screen in Gutenberg.

![image](https://i.imgur.com/4ImtYJU.png)

### → Step #2

Click on the add (+) block icon on the top left corner of the screen and search for _carousel_ to add a new _Carousel_ block to the editor.

![image](https://i.imgur.com/rMusQYi.png)

### → Step #3

Clicking on the block will toggle edit mode to access the settings. Block will always show the preview.

![image](https://i.imgur.com/5MTFy7J.gif)

**ACF Block Settings:**

![image](https://i.imgur.com/Qe6HIbD.png)

## 📚 Developer Documentation

### → Saving ACF JSON Files

By default, saving the ACF blocks to JSON files filter is set to save to the current theme. You will need to create the `acf-json` folder on the root of your theme and transfer the existing json files in `acf-json` to that folder. You can change to save in the plugin by changing the `$path` variable to `plugin_dir_path( dirname( __FILE__ ) ) . '/acf-json';` in this line: <https://github.com/WebDevStudios/wds-acf-blocks/blob/main/inc/hooks.php#L27>

To know more about loading and saving of blocks in ACF JSON files, visit the [Saving and Loading Blocks](https://github.com/WebDevStudios/wds-acf-blocks/wiki/Saving-and-Loading-Blocks) section in the Wiki.

### → Styling ACF Blocks

Styling blocks will be done in the theme and not in the plugin. The `accordion` block has a starter stylesheet that can be copied over to the theme, this contains the base style to make the accordion work and can be modified as needed. The `carousel` block is using the default `glider-js` stylesheet.

### → Important Wiki Links

Please find extensive developer documentation at the following links:

- [WDS ACF Blocks](https://github.com/WebDevStudios/wds-acf-blocks/wiki/WDS-ACF-Blocks)
- [Block Features](https://github.com/WebDevStudios/wds-acf-blocks/wiki/WDS-ACF-Blocks#block-features)
- [Block Details](https://github.com/WebDevStudios/wds-acf-blocks/wiki/WDS-ACF-Blocks#block-details)
- [How to create Gutenberg Blocks with ACF](https://github.com/WebDevStudios/wds-acf-blocks/wiki/WDS-ACF-Blocks#creating-gutenberg-blocks-with-acf)
- [Saving and Loading Blocks](https://github.com/WebDevStudios/wds-acf-blocks/wiki/Saving-and-Loading-Blocks)
- [Glider.js - Carousel](https://nickpiscitelli.github.io/Glider.js/)

## :octocat: Contributing and Support

Your contributions and [support tickets](https://github.com/WebDevStudios/wds-acf-blocks/issues) are welcome. Please see our [guidelines](https://github.com/WebDevStudios/wds-acf-blocks/blob/master/.github/CONTRIBUTING.md) before submitting a pull request.
