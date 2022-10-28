# Overview

[Documentation Navigation](#documentation-navigation)

If you have the latest version of [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/pro/) - ACF 6.0+ is required for this plugin to work correctly - then you can take advantage of our ACF Blocks system. ACF blocks are a great way to visually manage blocks of content throughout your website.

## Available Blocks

-   [Accordion](#accordion)
-   [Cards (Repeater)](#cards-repeater)
-   [Carousel](#carousel)
-   [Logo Grid](#logo-grid)
-   [Quotes](#quotes)
-   [Side-by-Side](#side-by-side)
-   [Tabs](#tabs)

## How the Blocks are defined and registered

The blocks in the WDS ACF Blocks plugin use the new (WordPress 5.8 onwards) `block.json` method of registration. This has been supported since ACF 6.0. Learn more details around the parameters of registering and defining block properties below.

## Block Features

Each ACF Block supports the following:

-   Background color (using Gutenberg's background color control)
-   Text color (using Gutenberg's text color control)
-   Inner Blocks (if allowed in the block options)

These options are in addition to native Gutenberg settings like:

-   Custom CSS classes
-   HTML Anchor (AKA custom element ID)
-   Drag-n-Drop sorting

## Recommendations and Best Practices

To style these blocks alongside a theme, consider the following approach.

Global theme styles should be added to your accompanying theme. This should include your global fonts, colors, etc and should exist inside your Tailwind Preset as well as in your theme's SCSS.

Global block styles should be added to `/assets/global-styles/frontend-styles.scss` (and/or `admin-styles.scss`, as appropriate).

Scoped block styles should be added to each block's `style.scss` or `editor.scss` as appropriate.

## Creating Gutenberg Blocks with the WDS ACF Blocks plugin

If you’re familiar with creating ACF Field Groups as post meta, you’re 80% of the way to creating a Gutenberg block using ACF. Below, we’ll walk through how to register and create a Gutenberg block with Advanced Custom Fields.

### Registering The Block

In the block's folder (in our case, `/src/blocks/block-name.php`), you’ll need to register your block, along with setting any options for that block that you'd like to enable. We’ll show this example with a single block, but you can see the full file below.

Our script will automatically register your block with WordPress once the build (or watch) process is completed. You can achieve this with `npm run build` or `npm run start` in the root plugin folder.

```json
{
	"name": "abs/accordion",
	"title": "Accordion",
	"description": "A block used to show an Accordion.",
	"editorStyle": "file:./editor.css",
	"editorScript": "file:./editor.js",
	"style": "file:./style-script.css",
	"script": "file:./script.js",
	"category": "WDS",
	"icon": "table-row-before",
	"apiVersion": 2,
	"keywords": [ "accordion", "block" ],
	"acf": {
		"mode": "auto",
		"renderTemplate": "accordion.php"
	},
	"supports": {
		"align": false,
		"anchor": true,
		"color": true,
		"customClassName": true,
		"jsx": true
	},
	"example": {
		"attributes": {
			"mode": "preview",
			"data": {
				"_is_preview": "true"
			}
		}
	}
}
```

You’ll notice a custom category in the above snippet: **WDS**. This is registered as part of the plugin and will need to be updated when you customize the plugin for your own use.

Let’s take a look at how all of this comes together.

### The Build

You can see what's in `block.json` and the files in the `/src/blocks/blockname` folder - how does this connect to WordPress to build a block.

Starting in WordPress 5.8, WordPress allows for registration of a block inside `block.json`. This will typically be housed inside a folder that contains all of a block's files. In ACF parlance, this is a ["portable block"](https://gladdy.uk/blog/2022/07/24/creating-portable-acf-blocks/) (though it's not quite as portable as you might hope). All the files in any block's folder should contain all of the elements for it to be compiled, minified and/or "built" - at which point, WordPress will move it to the `/build` folder, with mostly the same structure intact. This is done with the `wp-scripts` NPM package.

### Why is this better?

Now that you've built your block, WordPress will add it as a block to be used within Gutenberg. This new method conveys some advantages - WordPress will now automatically load that block's files _when that block is inserted_ into any given page. The scripts and styles won't be enqueued otherwise - this allows that block's CSS and JS to remain somewhat "scoped" to that block as it will only ever be loaded as needed.

This also allows for a huge benefit in performance, along with the obvious benefit of separation of concerns.

### The Block Name

```json
"name": "abs/accordion",
```

The importance of this is that every block will need to be namespaced. In this example, the name is written as `"name": "namespace/blockname"`. Our namespace is `abs` (for ACF Block Starter); the name of this block is `accordion`. You can technically leave off the namespace, and ACF will automatically use the `acf` namespace instead. In the interest of best practices, we opted to define our own namespace here - it should be updated, along with the namespace throughout the plugin - if you are using it in a production environment.

### ACF Attributes

```json
"acf": {
	"mode": "auto",
	"renderTemplate": "accordion.php"
},
```

**Mode**
This option let you specify how you'd like the block to display when it is added to Gutenberg.

Your options are: `preview`, `edit`, `auto`.

**Render Template**
`renderTemplate` tells WordPress which file to render this block with. As the file is inside the same folder (in this case) as `block.json`, no path is required.

### Supports

```json
"supports": {
	"align": false,
	"anchor": true,
	"color": true,
	"customClassName": true,
	"jsx": true
},
```

#### align

Align should be left as `false`. Even if removed, this property is occasionally not respected by WordPress and the alignment control will display. The `.alignwide`, `.alignfull`, etc classes are not functional on the blocks within the WDS ACF Blocks plugin as we are manually defining the block alignment in SCSS.

#### anchor

This allows you to specify if you'd like your block to support the `anchor` field, enabling you to define a custom ID for that block.
[WP Docs](https://developer.wordpress.org/block-editor/reference-guides/block-api/block-supports/#anchor)

#### color

This allows you to specify if you'd like your block to support the `color` block controls, enabling background color and text color options. The colors will be pulled from the defined colors in `theme.json`.
[WP Docs](https://developer.wordpress.org/block-editor/reference-guides/block-api/block-supports/#color)

#### customClassName

This allows you to specify if you'd like your block to support the `customClassName` block field, allowing a user to add custom classes to the block in the Gutenberg editor.
[WP Docs](https://developer.wordpress.org/block-editor/reference-guides/block-api/block-supports/#customclassname)

#### jsx

This allows the `<InnerBlocks />` Component to function inside Gutenberg. If this is disabled, Inner Blocks will stop functioning for this block.
[WP Docs](https://developer.wordpress.org/block-editor/how-to-guides/block-tutorial/nested-blocks-inner-blocks/)

### Styles and Scripts

```json
"editorStyle": "file:./editor.css",
"editorScript": "file:./editor.js",
"style": "file:./style-script.css",
"script": "file:./script.js",
```

These are the files that WordPress will enqueue with your registered block. You can have separate styles and scripts for both the front and back-end of WordPress.

For example, `"editorStyle": "file:./editor.css"` will **only** load in the WordPress Admin area. You can also enqueue previously registered scripts with their handle (ie: `'my-super-admin-javascript'`), or a combination of handle/filename. [Read all about it here.](https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#editor-script)

#### Defining A Category

Adding a custom block category is as easy as hooking into `block_categories_all` ([introduced in WordPress 5.8](https://developer.wordpress.org/reference/hooks/block_categories_all/)). By doing so, we can define a custom category in `block.json` so we can keep our blocks stored away in their own drawer in the Block Menu.

The block category is registered in `/inc/helpers/register-block-category.php; the code is displayed below.

```php
<?php
/**
 * Registers a 'WDS' block category with Gutenberg.
 *
 * @package abs
 */

add_filter(
	'block_categories_all',
	function( $categories ) {

		// Adding a new category.
		$categories[] = array(
			'slug'  => 'WDS',
			'title' => 'WebDevStudios Blocks',
		);

		return $categories;
	}
);
```

Choosing that category is as simple as adding that newly-defined category to your block:

```json
"category": "WDS",
```

You can revert to the default by setting it to `"category": "theme",` if you prefer, or update it to use your own category name.

## Block Details

**Inner Blocks:** All of these blocks support `<InnerBlocks />`, which will appear (by default) above the Block elements themselves. The `core/heading` and `core/paragraph` blocks are allowed as `<InnerBlocks />`. The allowed Inner Blocks and the location of them is customizable to your liking.

### Accordion

The Accordion Block allows for adding several accordion items to a block to be displayed in a single column. Inner Blocks are supported.

### Cards Repeater

The Cards Repeater Block uses a repeater to allow you to add as many cards as you wish to a block. The Elements supported for each card are:

-   Image
-   Eyebrow
-   Heading
-   Meta
-   Content
-   Button

### Carousel

The Carousel Block allows you to create up to 12 slides in a carousel. This uses [Swiper](https://swiperjs.com) under the hood.

Each Carousel Slide uses the `carousel-slide` module. This module is expecting the following fields, which will be passed down to the corresponding elements:

-   Image
-   Eyebrow
-   Heading
-   Content
-   Button

The overlay is handled by the `overlay` field at the top level; it will apply to all slides in the carousel, if set.

### Logo Grid

The Logo Grid Block allows you to add as many logos as you wish - they will be displayed in a grid.

### Quotes

The Quotes Block allows you to add as many quotes as you wish - they will be displayed stacked.

### Side-by-Side

The Side-by-Side Block allows you to create three different combinations of layouts. Media + Text. Text + Media. Or Text + Text via a WYSIWYG editor and media upload field.

## Documentation Navigation

-   [Overview](Home.md)
-   [Philosophy](Philosophy.md)
-   [Functions](Functions.md)
-   [Blocks](Blocks.md)
-   [Modules](Modules.md)
-   [Elements](Elements.md)
-   [Scripts](Scripts.md)
-   [WP-CLI](WP-CLI.md)
