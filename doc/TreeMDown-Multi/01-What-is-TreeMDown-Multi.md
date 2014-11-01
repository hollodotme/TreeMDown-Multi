# What is TreeMDown-Multi?

TreeMDown-Multi is an extension of TreeMDown to enable browsing and searching in multiple trees of markdown files.

## Why this?

If you're using or maintaining a project that depends on multiple software packages (e.g. via [composer](https://getcomposer.org)) and each of these packages includes a
documentaiton using markdown files, TreeMDown-Multi enables you to bring all the documentation to a single Page.

## Live demo

This page is completely made with TreeMDown-Multi. Don't freeze and browse the trees! :)

## Installation

### Via composer

```json
{
    "require": {
        "hollodotme/treemdown-multi": "~1.0"
    }
}
```

### Manually by source

Download the source from [GitHub](https://github.com/hollodotme/TreeMDown-Multi).

## Basic usage

```php
// Require composer autoloading
require_once 'vendor/autoload.php';

use hollodotme\TreeMDown\TreeMDown;
use hollodotme\TreeMDownMulti\TreeMDownMulti;

$multi_view = new TreeMDownMulti();

$multi_view->addTree( new TreeMDown(__DIR__ . '/my_docs'), 'My documents');
$multi_view->addTree( new TreeMDown(__DIR__ . '/your_docs'), 'Your documents');

$multi_view->display();
```

## Advanced usage

You can configure each of the TreeMDown instances to fit your needs.
Please select one of the "TreeMDown documentation" trees to learn more about all available options.

Here is a simplyfied example:

```php
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