# Elements

[Documentation Navigation](#documentation-navigation)

Elements are the smallest componets on the atomic level designs. They are rendered by the `print_element()` function. They are the building blocks of the modules and blocks.

## Anchor Element

The anchor element is a simple link that can be used to link to another page or section on the same page.
It can be used in the following ways:

```php
<?php
print_element( 'anchor', [
    'text'      => 'Anchor Text',
    'href'      => 'https://example.com',
    'target'    => '_blank',
    'class'     => [ 'wds-element', 'wds-element-anchor' ],
] );
?>
```

## Badge Element

The badge element is made up of simple html elemets that can be used to display a label or status.
It can be used in the following ways:

```php
<?php
print_element( 'badge', [
    'class'         => [ 'wds-element', 'wds-element-badge' ],
	'id'            => '',
	'text'          => 'Badge Text',
	'href'          => '',
	'target'        => '',
	'type'          => 'default',
	'icon'          => [],
	'icon_position' => 'after', // before, after.
] );
?>
```

## Blockquote Element

The blockquote element is made up of simple html elemets that can be used to display a quote.
It can be used in the following ways:

```php
<?php
print_element( 'blockquote', [
	'class' => [ 'wds-element', 'wds-element-blockquote' ],
	'id'    => '',
	'cite'  => '',
	'quote' => '',
] );
?>
```

## Button Element

The button element is a simple button that can be used to display a button.
It can be used in the following ways:

```php
<?php
print_element( 'button', [
	'class'         => [ 'wds-element', 'wds-element-button' ],
	'id'            => '',
	'title'         => '',
	'href'          => '',
	'target'        => '',
	'type'          => '',
	'icon'          => [],
	'icon_position' => 'after', // before, after.
	'role'          => '',
	'aria'          => [
		'controls' => '',
		'disabled' => '',
		'expanded' => '',
		'label'    => '',
	],
] );
?>
```

## Content Element

The content element is a simple element that can be used to display content.
It can be used in the following ways:

```php
<?php
print_element( 'content', [
	'class'   => [ 'wds-element', 'wds-element-content' ],
	'id'      => '',
	'content' => '',
] );
?>
```

## Eyebrow Element

Similar to the content element, the eyebrow element is a simple element that can be used to display content.
It can be used in the following ways:

```php
<?php
print_element( 'eyebrow', [
    'class'   => [ 'wds-element', 'wds-element-eyebrow' ],
    'content' => '',
] );
?>
```

## Heading Element

The heading element is a simple html element that can be used to display a heading. You can define the heading level by passing the `level` parameter.
It can be used in the following ways:

```php
<?php
print_element( 'heading', [
	'class' => [ 'wds-element', 'wds-element-heading' ],
	'id'    => '',
	'text'  => false,
	'level' => 2,
] );
?>
```

## Icon Element

The icon element is a simple element that can be used to display an SVG icon.
It can be used in the following ways:

```php
<?php
print_element( 'icon', [
	'class'    => [ 'wds-element', 'wds-element-icon' ],
	'svg_args' => [],
] );
?>
```

## Image Element

The image element is a simple element that can be used to display an image. You can either use the attachment ID or the image URL to display the image.
It can be used in the following ways:

```php
<?php
print_element( 'image', [
	'class'         => [ 'wds-element', 'wds-element-image' ],
	'attachment_id' => false,
	'src'           => false,
	'size'          => 'large',
	'loading'       => 'lazy',
	'alt'           => '',
] );
?>
```

## Input Element

The input element is a simple element that can be used to display an input field. You can define the input type by passing the `type` parameter.
It can be used in the following ways:

```php
<?php
print_element( 'input', [
	'class'       => [ 'wds-element', 'wds-element-button' ],
	'type'        => 'text',
	'name'        => '',
	'value'       => '',
	'placeholder' => false,
	'disabled'    => false,
	'required'    => false,
] );
?>
```

## Label Element

The label element is a simple element that can be used to display a label.
It can be used in the following ways:

```php
<?php
print_element( 'label', [
	'class' => [ 'wds-element', 'wds-element-button' ],
	'text'  => false,
	'for'   => false,
] );
?>
```

## Logo Element

The logo element is a simple element that can be used to display a logo. The logo element uses the site logo which can be set in the customizer.
It can be used in the following ways:

```php
<?php
print_element( 'logo', [
	'class'     => [ 'wds-element', 'wds-element-logo' ],
	'logo_name' => '',
	'loading'   => 'eager',
	'alt'       => get_bloginfo( 'name' ) . ' logo',
] );
?>
```

## Select Element

The select element is a simple element that can be used to display a select field. Naturally the options are passed as an array on the `options` parameter.
It can be used in the following ways:

```php
<?php
print_element( 'select', [
	'class'    => [ 'wds-element', 'wds-element-select' ],
	'name'     => false,
	'value'    => false,
	'disabled' => false,
	'required' => false,
	'options'  => [],
] );
?>
```

## TextArea Element

The textarea element is a simple element that can be used to display a textarea field.
It can be used in the following ways:

```php
<?php
print_element( 'textarea', [
	'class'       => [ 'wds-element', 'wds-element-textarea' ],
	'name'        => '',
	'value'       => '',
	'placeholder' => false,
	'disabled'    => false,
	'required'    => false,
	'readonly'    => false,
] );
?>
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
