# WDS ACF Blocks

With the advent of Gutenberg in WordPress, Advanced Custom Fields stepped up to help make the process of creating custom blocks easier and faster. This plugin creates a set of custom blocks with basic styles for you to customize in your theme.

<a href="https://webdevstudios.com/contact/"><img src="https://webdevstudios.com/wp-content/uploads/2018/04/wds-github-banner.png" alt="WebDevStudios. Your Success is Our Mission."></a>

## 🧱 Available Blocks

This plugin includes the following blocks:

-   Accordion
-   Carousel
-   Call To Action
-   Fifty/Fifty
-   Hero
-   Recent Posts
-   Related Posts

<div align="center"><img src="https://i.imgur.com/Ffk7dGC.jpg" width="400"></div><br>

WDS ACF Blocks is bundled with a [Style Lint](https://stylelint.io/), [ESLint](https://eslint.org/), and [PHPCS](https://github.com/squizlabs/PHP_CodeSniffer) linting rulesets – plus, it passes both WCAG 2.1AA and Section 508 standards out of the box.

To better manage ACF Field Groups, the plugin supports [synchronized JSON](https://www.advancedcustomfields.com/resources/synchronized-json/) for Advanced Custom Fields.

👉 Please visit the [WDS ACF Blocks Wiki](https://github.com/WebDevStudios/wds-acf-blocks/wiki/WDS-ACF-Blocks) to learn more about the [features of the blocks](https://github.com/WebDevStudios/wds-acf-blocks/wiki/WDS-ACF-Blocks#block-features) and how you can [create Gutenberg Blocks with ACF](https://github.com/WebDevStudios/wds-acf-blocks/wiki/WDS-ACF-Blocks#creating-gutenberg-blocks-with-acf).

## 📚 Developer Documentation

Please find extensive developer documentation at the following links:

- [WDS ACF Blocks](https://github.com/WebDevStudios/wds-acf-blocks/wiki/WDS-ACF-Blocks)
- [Block Features](https://github.com/WebDevStudios/wds-acf-blocks/wiki/WDS-ACF-Blocks#block-features)
- [Block Details](https://github.com/WebDevStudios/wds-acf-blocks/wiki/WDS-ACF-Blocks#block-details)
- [How to create Gutenberg Blocks with ACF](https://github.com/WebDevStudios/wds-acf-blocks/wiki/WDS-ACF-Blocks#creating-gutenberg-blocks-with-acf)
- [Saving and Loading Blocks](https://github.com/WebDevStudios/wds-acf-blocks/wiki/Saving-and-Loading-Blocks)

## 📝 Requirements

-   [Node LTS](https://nodejs.org/en/)
-   [Composer](https://getcomposer.org/)
-   [WordPress](https://wordpress.org/)
-   [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/pro/)
-   [wd_s](https://github.com/WebDevStudios/wd_s)

_We highly recommend [NVM](https://github.com/nvm-sh/nvm) so you can easily switch between Node versions._

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
npm run dev
```

![image](https://i.imgur.com/n2FEkhB.jpg)

To build the production version, execute this command:

```bash
npm run build
```

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

## :octocat: Contributing and Support

Your contributions and [support tickets](https://github.com/WebDevStudios/wds-acf-blocks/issues) are welcome. Please see our [guidelines](https://github.com/WebDevStudios/wds-acf-blocks/blob/master/.github/CONTRIBUTING.md) before submitting a pull request.
