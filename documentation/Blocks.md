# Blocks

The file & folder structure for a block is as follows:

```
src/blocks
  blockname
    blockname.php // render template
    block.json // block registration
    editor.js // editor JavaScript
    editor.scss // editor styles (in SCSS, to be compiled on build)
    script.js // frontend scripts
    styles.scss // frontend styles
    tailwind.config.js // Tailwind config; will pull in the theme preset, if one exists
```

All of the above is compiled by WP Scripts and built into the `/build` folder.

## The `/build` folder

**IMPORTANT**: This `/build` folder is _not_ tracked and hence will need to be moved to the server (on deploy or with a CI/CD tool) in order for it to exist on your host.

This folder will exist after you run `npm run build` or `npm run start`. `start` will watch the files and do a continuous build of anything that changes, while `build` will run one time. Inside this folder, you'll find the same folder structure as inside `/src/blocks` but with compiled & minified files inside.

## Functions used inside the Block render partial (`blockname.php`)

```
use function WebDevStudios\abs\print_module;
use function WebDevStudios\abs\print_element;
use function WebDevStudios\abs\get_acf_fields;
use function WebDevStudios\abs\setup_block_defaults;
```

A block will use most (but perhaps not all) of the above functions to render - take a look at [Functions](Functions.md) for more detail.

Put simply, each of the functions will perform a task that is indicated by their names.

- `print_module` will print a module
- `print_element` will print an element
- `get_acf_fields` will return the values of passed in ACF Fields (in the form of an array)
- `setup_block_defaults` will return `$abs_defaults` as an updated array and `$abs_atts` as a formatted string, using the following functions:
  - `get_block_classes` will return classes for the block from Gutenberg for the following:
    - `$block['className']`
    - `$block['backgroundColor']`
    - `$block['textColor']`
  - `get_formatted_atts` will return a string of attributes

## Block Defaults

Each block sets up it's own consistent defaults. This is an array composed (typipcally) of the following key/value pairs.

- class => array of classes
- allowed_innerblocks => array of blocks allowed inside this block
- id => int; set by the Gutenberg control in the admin
- fields => array of fields, if block is being rendered by `print_block()`

This array looks like this:

```
$abs_defaults = [
	'class'               => [ 'wds-block', 'wds-block-accordion' ],
	'allowed_innerblocks' => [ 'core/heading', 'core/paragraph' ],
	'id'                  => ( isset( $block ) && ! empty( $block['anchor'] ) ) ? $block['anchor'] : '',
	'fields'              => [], // Fields passed via the print_block() function.
];
```

## Block Previews

Blocks will render a preview of themselves in the Gutenberg block picker, when a block preview image is put into `/assets/images/block-previews/blockname-preview.jpg`.

## Inner Blocks

Blocks can accept Inner Blocks. This can be disabled in several ways; the easiest is to simply update the `$abs_defaults` array with `'allowed_innerblocks' => []`. Alternatively, you can also set `'jsx' => false` inside that block's `block.json`.

There can be only one location for Inner Blocks - either before or after your block's render partial.

The Inner block "dropzone" will be rendered with a dotted border so it makes it visible in the admin. This is added via the global `admin-styles.scss` inside `./assets/global-styles` folder. It will be built automatically along with the blocks.

**Note:** Remember to add the allowed blocks' names to the ACF Field Group so that your clients know which blocks can be used.
