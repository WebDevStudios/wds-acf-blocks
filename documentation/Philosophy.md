# Philosophy

[Documentation Navigation](#documentation-navigation)

The main idea around the WDS ACF Blocks Plugin (internally called the ACF Block Starter) is to abstract repetitive development tasks into template parts. These template parts would receive a structured array of data, allowing them to render to the frontend.

This method was adopted in order to accomplish the following:

-   eliminate inconsistencies among different members of a team working on the same project
-   formalize a method by which blocks are built, structured, and rendered - and by proxy, how their internal DOM structure is rendered
-   simplifies development by encapsulating all development within a constrained set of methods and functions
-   introduce a naming convention by which all future block development would ahdere to
-   encapsulate all enqueued block files into a single location
-   by virtue of the above goals, this would hopefully speed up development, while at the same time making it easier to build blocks quickly with more consistency and less overlap

## Blocks, Modules and Elements, oh my

In order to achieve the above goals, the plan was to follow Brad Frost's [Atomic Design methodology](https://atomicdesign.bradfrost.com/table-of-contents/). Shortly after moving in this direction, a couple issues came up that made us shift the paradigm slightly.

One of the issues was that the naming convention that Brad Frost uses is rigid and don't feel well coupled to the WordPress architecture. Organisms, in WordPress, could be a nav... or a template part. Is it both? Where is the line drawn between these things? The other issue is that WordPress already has _it's own_ paradigm - Templates, Template Parts, Blocks. We decided to focus on Blocks and loosely drape the concepts of Atomic Design over the Block model.

To that end, we came up with: Blocks, Modules and Elements. Read on to learn how they fit together.

## Blocks

Blocks are the building block ;) of this system. They are somewhat analagous to Organisms in that they can be composed of many modules and/or elements. They can have logic (if necessary). What the block handles:

-   it defines the classes for the block, including any applied within Gutenberg
-   it adds an ID from the Gutenberg input field, if set
    -   the Classes and ID are subsequently automatically inlined as an attribute string into the `<section>`, which is typically the block's root DOM element
-   it determines which Inner Blocks are allowed and where they are rendered
-   it retrieves the associated ACF Fields and adds them to a block array
    -   it then passes this array down to whichever modules or elements it uses to render the block

## Modules

Modules are nothing more than a collection of elements. They are analagous to Molecules in Atomic Design, but with a slightly expanded scope. Their primary reason for being is to speed up development by clustering a group of elements together.

A module will accept an array from the block and pass those values down to a collection of elements, which then will render them. The module also provides a means of wrapping a group of elements, as needed.

A module shouldn't have logic - for example, a card module would render many elements, one after another. You could use logic to reorder these elements dynamically, but it is much simpler and faster to simply copy and paste the module to display the elements in a different order.

The lack of logic also adheres strongly to the core philosophy of simplifying development.

## Elements

Elements are analagous to Atoms in Atomic Design. In most cases, they render (as you would expect) a DOM element, nothing more. They accept values as an array passed down from a Block or Module and render those values to the screen. Again, Elements should use very little logic in order to adhere to the principle of simplicity.

## Build your own, use them in your theme

If a Module or an Element is missing - build your own! For example, you may need a Breadcrumb Module (a collection of anchors, maybe) or an `<hr>` Element - go ahead and build it!

### Theme use

You can use the `print_element`, `print_module`, or `print_block` functions within the theme. In order to use those functions, you'll have to know the "shape" of the array for the fields.

Example Usage in a template part.

Add to the top of your file:
`use function WebDevStudios\abs\print_block;`

```php
// Prints a Call to Action Block.
if ( function_exists( 'WebDevStudios\abs\print_block' ) ) :
  print_block(
    'call-to-action',
    [
      'allowed_innerblocks' => [],
      'fields'              => [
          'eyebrow'     => 'CTA Eyebrow text',
          'heading'     => 'CTA Heading text',
          'content'     => '<p>Lorem ipsum dolor sit amet.</p>',
          'button_args' => [
            'button' => [
              'title'  => 'CTA Button Text',
              'url'    => 'https://webdevstudios.com',
              'target' => '',
            ],
          ],
          'layout' => 'center',
      ],
    ]
  );
endif;
```

## Documentation Navigation

-   [Overview](Home.md)
-   [Philosophy](Philosophy.md)
-   [Functions](Functions.md)
-   [Blocks](Blocks.md)
-   [Modules](Modules.md)
-   [Elements](Elements.md)
-   [Scripts](Scripts.md)
-   [WP-CLI](WP-CLI.md)
