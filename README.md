WDS ACF Blocks
===
With the advent of Gutenberg in WordPress, Advanced Custom Fields stepped up to help make the process of creating custom blocks easier and faster. This plugin creates a set of custom blocks with basic styles for you to customize in your theme.

This plugin includes the following blocks:
- Accordion
- Call To Action
- Carousel
- Fifty/Fifty
- Hero
- Recent Posts
- Related Posts

WDS ACF Blocks is bundled with a [Style Lint](https://stylelint.io/), [ESLint](https://eslint.org/), and [PHPCS](https://github.com/squizlabs/PHP_CodeSniffer) linting rulesets – plus, it passes both WCAG 2.1AA and Section 508 standards out of the box.

To better manage ACF Field Groups, the plugin supports [synchronized JSON](https://www.advancedcustomfields.com/resources/synchronized-json/) for Advanced Custom Fields.

<a href="https://webdevstudios.com/contact/"><img src="https://webdevstudios.com/wp-content/uploads/2018/04/wds-github-banner.png" alt="WebDevStudios. WordPress for big brands."></a>

## Getting Started

### Prerequisites

Because the plugin compiles and bundles assets via NPM scripts, basic knowledge of the command line and the following dependencies are required: [Node LTS](https://nodejs.org) and NPM.

## Installation

1. From the command line, change directories to your new theme directory:

```bash
cd /plugin/wds-acf-gutenberg
```

2. Install plugin dependencies and trigger an initial build:

```bash
npm i
```

### NPM Scripts

From the command line, type any of the following to perform an action:

`npm run build` - Compile and build all assets .

`npm run watch` - Automatically handle changes to CSS, JS, SVGs, and image sprites.

## Contributing and Support

Your contributions and [support tickets](https://github.com/WebDevStudios/wds-acf-blocks/issues) are welcome. Please see our [guidelines](https://github.com/WebDevStudios/wds-acf-blocks/blob/master/.github/CONTRIBUTING.md) before submitting a pull request.
