<?php
/**
 * Example script for using TreeMDown-Multi
 *
 * @author hollodotme
 */

// include composer autoloading
require_once __DIR__ . '/../vendor/autoload.php';

// IMPORTANT: Don't use hollodotme\**TreeMDown**\TreeMDown here!
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
