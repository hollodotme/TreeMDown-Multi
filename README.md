# TreeMDown-Multi

This is an extension of [TreeMDown](https://github.com/hollodotme/TreeMDown) to handle and display multiple trees of markdown files.

## Installation

### Via composer

Checkout the current release at [packagist.org](http://packagist.org/hollodotme/treemdown-multi).

Add to your `composer.json`:

```json
{
	"require": {
		"hollodotme/treemdown-multi": "~1.0"
	}
}
```

## Basic usage

```php
<?php

// Require composer autoloading
require_once 'vendor/autoload.php';

use hollodotme\TreeMDown\TreeMDown;
use hollodotme\TreeMDownMulti\TreeMDownMulti;

$multi_view = new TreeMDownMulti();

$multi_view->addTree( new TreeMDown(__DIR__ . '/my_docs'), 'My documents');
$multi_view->addTree( new TreeMDown(__DIR__ . '/your_docs'), 'Your documents');

$multi_view->display();

```

## Advanced Usage

You can configure each of the TreeMDown instances to fit your needs.
Please visit the [documentation of TreeMDown](http://hollo.me/treemdown) to see all available options.

Here is a simplyfied example:

```php
<?php

// include composer autoloading
require_once 'vendor/autoload.php';

// IMPORTANT: Don't use hollodotme\**TreeMDown**\TreeMDown here!
// This package has an extended TreeMDown class

use hollodotme\TreeMDownMulti\TreeMDown;
use hollodotme\TreeMDownMulti\TreeMDownMulti;

// Create instance
$multi_view = new TreeMDownMulti();

// Configure your markdown primary dir
$tree1 = new TreeMDown( '/path/to/your/markdown/files' );
$tree1->hideEmptyFolders();
$tree1->setProjectName( 'Your markdown files' );
$tree1->enablePrettyNames();
$tree1->hideFilenameSuffix();

// Configure other dir
// Note: No output options set to show the difference
$tree2 = new TreeMDown( '/path/to/other/markdown/files' );
$tree2->setProjectName( 'Other markdown files' );

// Make "Yours" default (3rd parameter)
$multi_view->addTreeMDown( $tree1, 'Yours', true );
$multi_view->addTreeMDown( $tree2, 'Others' );

// Display
$multi_view->display();

```
