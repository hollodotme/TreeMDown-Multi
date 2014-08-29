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

// Require composer autoloading
require_once 'vendor/autoload.php';

use hollodotme\TreeMDown\TreeMDown;
use hollodotme\TreeMDownMulti\TreeMDownMulti;

$multi_view = new TreeMDownMulti();

$my_docs_tree = new TreeMDown(__DIR__ . '/my_docs');
$my_docs_tree->hideEmptyFolders();
$my_docs_tree->setProjectName('My docs');

$your_docs_tree = new TreeMDown(__DIR__ . '/your_docs');
$your_docs_tree->showEmptyFolders();
$your_docs_tree->setProjectName('Your docs');

$multi_view->addTree( $my_docs_tree, 'My documents');
$multi_view->addTree( $your_docs_tree, 'Your documents');

$multi_view->display();

```
