# WDS ACF Blocks

With the advent of Gutenberg in WordPress, Advanced Custom Fields stepped up to help make the process of creating custom blocks easier and faster. This plugin creates a set of custom blocks with basic styles for you to customize in your theme.

This plugin includes the following blocks:

-   Accordion
-   Call to Action
-   Cards (Repeater, up to 3)
-   Carousel
-   Logo Grid
-   Quotes
-   Side-by-Side
-   Tabs

WDS ACF Blocks is bundled with [Style Lint](https://stylelint.io/), [ESLint](https://eslint.org/), and [PHPCS](https://github.com/squizlabs/PHP_CodeSniffer) linting rulesets – plus, it passes both WCAG 2.1AA and Section 508 standards out of the box. This plugin uses WP Scripts to handle the build process for the blocks. It uses

To better manage ACF Field Groups, the plugin supports [synchronized JSON](https://www.advancedcustomfields.com/resources/synchronized-json/) for Advanced Custom Fields.

<a href="https://webdevstudios.com/contact/"><img src="https://webdevstudios.com/wp-content/uploads/2018/04/wds-github-banner.png" alt="WebDevStudios. WordPress for big brands."></a>

## Getting Started

### Prerequisites

Because the plugin compiles and bundles assets via NPM scripts, basic knowledge of the command line and the following dependencies are required: [Node LTS](https://nodejs.org) and NPM.

#### IMPORTANT

This plugin relies entirely on Advanced Custom Fields _Pro_ for WordPress. The Pro version is _required_, along with a version _greater_ than 6.0 - it will not work with any ACF 5.x version. Additonally, the WebDevStudios theme `wd_s` is _required_ - there are dependencies in the theme that this plugin relies on.

## Who this plugin is for

It is important to be aware of who this plugin is designed for - this is squarely aimed at developers who want to **use it as a starter** to scaffold out a lot of blocks _quickly_ for a project. This is ideal for that case, but it is entirely dependant on your ability to build scaffold them all yourself, along with the styling.

This is **not a 'drop in', do-it-all plugin for your next blog** - you'll have to understand PHP, JS, SCSS (and probably a good amount of Tailwind), and a complex build process to use this plugin.

The good news is that this plugin was designed to drastically speed up your workflow, keep your blocks consistent and keep your code DRY. If you're a developer - or a small team of developers - this plugin is for you.

## Installation

1) From the command line, change directories to your new theme directory:

```bash
cd /plugin/wds-acf-blocks
```

2) Install plugin dependencies and trigger an initial build:

```bash
npm i
```

### NPM Scripts

From the command line, type any of the following to perform an action:

`npm run build` - Compile and build all assets.

`npm run start` - Automatically compile the SCSS & Tailwind to CSS; minifies the JS. This will also build all the blocks using WP Scripts.

## Find and Replace

Start by doing a find and replace within the plugin to update the namespace and functioon prefix. Currently, this is set to `abs` (*A*CF *B*lock *S*tarter). The namespace and prefix need to match or you will get linting errors. Be careful when doing this as "abs" is also matched within the words `absolute`, `tabs`, `abstract`, etc.

The safest method is to do a search for `\abs` and `$abs_` and replace those with your new namespace.

We are additionally using a `CompanyName\ProjectName` style namespace - in our case, `WebDevStudios\abs`. To maintain consistency, you should consider using a similar structure - ie: `AcmeWidgets\acme`.

This requires the `wd_s` theme, but it's probably already been renamed to something else. Make sure that you update the path inside the `postcss.config.js` file that is looking for the Tailwind config inside the `wd_s` theme.

## Contributing and Support

Your contributions and [support tickets](https://github.com/WebDevStudios/wds-acf-gutenberg/issues) are welcome. Please see our [guidelines](https://github.com/WebDevStudios/wds-acf-gutenberg/blob/master/.github/CONTRIBUTING.md) before submitting a pull request.
