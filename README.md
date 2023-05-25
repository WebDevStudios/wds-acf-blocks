# WDS ACF Blocks

With the advent of Gutenberg in WordPress, Advanced Custom Fields stepped up to help make the process of creating custom blocks easier and faster. This plugin creates a set of custom blocks with basic styles for you to customize.

## Documentation

You'll find information around installation and getting started below. Start there to get everything installed and working. Once that's done, [go here for more detailed documentation](./documentation/Home.md).

## Included Blocks

This plugin includes the following blocks:

-   Accordion
-   Call to Action
-   Cards (Repeater, up to 3)
-   Carousel
-   Logo Grid
-   Quotes
-   Side-by-Side
-   Tabs

WDS ACF Blocks is bundled with [Style Lint](https://stylelint.io/), [ESLint](https://eslint.org/), and [PHPCS](https://github.com/squizlabs/PHP_CodeSniffer) linting rulesets – plus, it passes both WCAG 2.1AA and Section 508 standards out of the box. This plugin uses WP Scripts to handle the build process for the blocks.

To better manage ACF Field Groups, the plugin supports [synchronized JSON](https://www.advancedcustomfields.com/resources/synchronized-json/) for Advanced Custom Fields.

[![Image](https://webdevstudios.com/wp-content/uploads/2018/04/wds-github-banner.png)](https://webdevstudios.com/contact/)

## Getting Started

### Prerequisites

Because the plugin compiles and bundles assets via NPM scripts, basic knowledge of the command line and the following dependencies are required: [Node LTS](https://nodejs.org) and NPM.

> #### IMPORTANT
>
> This plugin relies entirely on Advanced Custom Fields _Pro_ 6.0+ for WordPress. The Pro version is _required_, along with a version _greater_ than > 6.0 - it will not work with any ACF 5.x version. Additonally, the WebDevStudios theme `wd_s` is _required_ - there are dependencies in the theme that this plugin relies on.

## Who this plugin is for

It is important to be aware of who this plugin is designed for - this is squarely aimed at developers who want to **use it as a starter** to scaffold out a lot of blocks _quickly_ for a project. This is ideal for that case, but it is entirely dependant on your ability to build them all yourself, along with styling all of the blocks individually. Additionally, this plugin uses Tailwind and relies on the accompanying theme's (wd_s) Tailwind preset. [Read more about Tailwind presets here.](https://tailwindcss.com/docs/presets) It requires the use of TailwindCSS 3.2.0+ as that release includes the ability to use multiple Tailwind configs. [Read more about multiple Tailwind configs here.](https://tailwindcss.com/docs/configuration#using-multiple-configurations)

This is **not a 'drop in', do-it-all plugin for your next blog** - you'll have to understand PHP, JS, SCSS (and probably a good amount of Tailwind), and a complex build process to use this plugin.

The good news is that this plugin was designed to drastically speed up your workflow, keep your blocks consistent and keep your code DRY. If you're a developer - or a small team of developers - this plugin is for you.

## Installation

Follow these steps:

From the command line, change directories to your new plugin directory:

```bash
cd /plugins/wds-acf-blocks
```

Install plugin dependencies and trigger an initial build:

```bash
npm i
```

### NPM Scripts

From the command line, type any of the following to perform an action:

`npm run build` - Compile and build all assets.

`npm run start` - Automatically compile the SCSS & Tailwind to CSS; minifies the JS. This will also build all the blocks using WP Scripts.

## Find and Replace

Start by doing a find and replace within the plugin to update the namespace and function prefix. Currently, this is set to `abs` (for (_A_)CF (_B_)lock (_S_)tarter). The namespace and prefix need to match or you will get linting errors. Be careful when doing this as "abs" is also matched within the words `absolute`, `tabs`, `abstract`, etc.

We are using a `CompanyName\ProjectName` style namespace - in our case, `WebDevStudios\abs`. To maintain consistency, you should consider using a similar structure - ie: `AcmeWidgets\acme`.

Snippets you will need to update:

-   `"name": "abs/` (block names)
-   `WebDevStudios\abs,abs` (prefixes in phpcs.xml.dist)
-   `WebDevStudios\abs;` (namespace)
-   `$abs_` (function prefix)
-   `@package abs` (package name)
-   `wds_acf_blocks` (plugin name)

---

**This requires the `wd_s` theme, but it's probably already been renamed to something else. Make sure that you update the path assigned to the Tailwind preset (named `tailwindPreset`, surprisingly) inside the `env.json` file. This sets the path for all of the Blocks' configs to the Tailwind config inside your newly-named theme. Follow the steps below for more detail.**

---

### Path to your theme's Tailwind Preset

This is a hardcoded path - required to satisfy VS Code's Intellisense functionality. Buddy (the CI/CD tool we use) may or may not have access to this file (if you're only committing the plugin, for example); as a result, it will download the preset from the `wd_s` theme to your plugin and use that. This file is named `fallbackPreset.js` and should not be committed - it is .gitignored by default.

To make the plugin work alongside your `wd_s` theme in your project, make sure to update the path to **your** theme, whatever it is now named. We use Local by Flywheel and MacOS. If you use a different setup, make sure the path works for your local configuration.

Start by copying the file `env-example.json` and name it `env.json`. Inside that file, update it to match the path to your Tailwind preset file. The file initially looks like this:

```json
{
	"tailwindPreset": "../../themes/your-wd_s-theme/wds.preset.js"
}
```

## Contributing and Support

Your contributions and [support tickets](https://github.com/WebDevStudios/wds-acf-blocks/issues) are welcome. Please see our [guidelines](https://github.com/WebDevStudios/wds-acf-blocks/blob/main/.github/CONTRIBUTING.md) before submitting a pull request.
