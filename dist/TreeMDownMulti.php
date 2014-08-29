<?php
/**
 * TreeMDown-Multi wrapper
 *
 * @author hollodotme
 */

namespace hollodotme\TreeMDownMulti;

use hollodotme\TreeMDown\TreeMDown;
use hollodotme\TreeMDownMulti\Misc\Opt;

/**
 * Class TreeMDownMulti
 *
 * @package hollodotme\TreeMDownMulti
 */
class TreeMDownMulti
{

	/**
	 * Root directories
	 *
	 * @var array|TreeMDown[]
	 */
	protected $_trees = array();

	/**
	 * Default tree (title)
	 *
	 * @var null|string
	 */
	protected $_default_tree = null;

	/**
	 * Add a TreeMDown instance
	 *
	 * @param TreeMDown $tree       TreeMDown instance
	 * @param string    $title      Tree title
	 * @param bool      $is_default Default tree?
	 */
	public function addTreeMDown( TreeMDown $tree, $title, $is_default = false )
	{
		$this->_trees[ $title ] = $tree;

		if ( !empty($is_default) )
		{
			$this->_default_tree = $title;
		}
	}

	/**
	 * Return the TreeMDown instances
	 *
	 * @return array
	 */
	public function getTrees()
	{
		return $this->_trees;
	}

	/**
	 * Return the TreeMDown instance at $title
	 *
	 * @param int $title Index
	 *
	 * @return null|TreeMDown
	 */
	public function getTree( $title )
	{
		if ( is_string( $title ) && isset($this->_trees[ $title ]) )
		{
			$tree = $this->_trees[ $title ];
		}
		else
		{
			$tree = null;
		}

		return $tree;
	}

	/**
	 * Return the current tree
	 *
	 * @return TreeMDown|null
	 */
	public function getCurrentTree()
	{
		return $this->getTree( $this->_getCurrentIndex() );
	}

	/**
	 * Return the output of current tree
	 *
	 * @param array $headers Headers
	 *
	 * @return string
	 */
	public function getOutput( array &$headers = array() )
	{
		$this->_prepareOptions();

		if ( !empty($this->_trees) )
		{
			$tree = $this->getCurrentTree();

			if ( ($tree instanceof TreeMDown) )
			{
				$output = $tree->getOutput( $headers );

				if ( $output instanceof \DOMDocument )
				{
					$this->_addTreeSelect( $output );
				}
			}
			else
			{
				$output = 'Something went wrong, this is not a valid tree.';
			}
		}
		else
		{
			$output = 'You need to add a tree to view some content.';
		}

		return $output;
	}

	/**
	 * Display the output
	 */
	public function display()
	{
		$headers = array();
		$output  = $this->getOutput( $headers );

		foreach ( $headers as $type => $value )
		{
			header( "{$type}: {$value}" );
		}

		if ( $output instanceof \DOMDocument )
		{
			$output->formatOutput = false;
			echo $output->saveHTML();
		}
		else
		{
			echo $output;
		}
	}

	/**
	 * Prepare the options
	 */
	protected function _prepareOptions()
	{
		$current_tree = $this->getCurrentTree();

		if ( $current_tree instanceof TreeMDown )
		{
			$current_tree->getOptions()->set( Opt::TREE_DEFAULT, $this->_default_tree );
			$current_tree->getOptions()->set( Opt::TREE_CURRENT, $this->_getCurrentIndex() );
		}
	}

	/**
	 * Return the current index
	 *
	 * @return null|string
	 */
	protected function _getCurrentIndex()
	{
		$index = $this->_default_tree;

		if ( isset($_GET['tmd_t']) && array_key_exists( strval( $_GET['tmd_t'] ), $this->_trees ) )
		{
			$index = strval( $_GET['tmd_t'] );
		}
		elseif ( is_null( $index ) || !array_key_exists( $index, $this->_trees ) )
		{
			$keys  = array_keys( $this->_trees );
			$index = reset( $keys );
		}

		return $index;
	}

	/**
	 * Add tree select form to sidebar
	 *
	 * @param \DOMDocument $dom
	 */
	protected function _addTreeSelect( \DOMDocument $dom )
	{
		$sidebar_column = $dom->getElementById( 'tmd-sidebar' );

		$select_form = $dom->createElement( 'form' );
		$select_form->setAttribute( 'method', 'get' );
		$select_form->setAttribute( 'action', '' );

		$sidebar_column->insertBefore( $dom->createElement( 'hr' ), $sidebar_column->firstChild );

		$sidebar_column->insertBefore( $select_form, $sidebar_column->firstChild );

		$hidden = $dom->createElement( 'input' );
		$hidden->setAttribute( 'type', 'hidden' );
		$hidden->setAttribute( 'name', 'tmd_q' );
		$hidden->setAttribute( 'value', isset($_GET['tmd_q']) ? $_GET['tmd_q'] : '' );
		$select_form->appendChild( $hidden );

		$hidden = $dom->createElement( 'input' );
		$hidden->setAttribute( 'type', 'hidden' );
		$hidden->setAttribute( 'name', 'tmd_f' );
		$hidden->setAttribute( 'value', '' );
		$select_form->appendChild( $hidden );

		$hidden = $dom->createElement( 'input' );
		$hidden->setAttribute( 'type', 'hidden' );
		$hidden->setAttribute( 'name', 'tmd_r' );
		$hidden->setAttribute( 'value', '' );
		$select_form->appendChild( $hidden );

		$group = $dom->createElement( 'div' );
		$group->setAttribute( 'class', 'form-group' );
		$select_form->appendChild( $group );

		$label = $dom->createElement( 'label', 'Select tree' );
		$label->setAttribute( 'class', 'sr-only' );
		$label->setAttribute( 'for', 'tmd-tree-select' );
		$group->appendChild( $label );

		$select = $dom->createElement( 'select' );
		$select->setAttribute( 'name', 'tmd_t' );
		$select->setAttribute( 'size', '1' );
		$select->setAttribute( 'class', 'form-control' );
		$select->setAttribute( 'onchange', 'this.form.submit();' );
		$group->appendChild( $select );

		$current_index = $this->_getCurrentIndex();
		foreach ( array_keys( $this->_trees ) as $title )
		{
			$option = $dom->createElement( 'option', $title );
			$option->setAttribute( 'value', $title );
			if ( $current_index == $title )
			{
				$option->setAttribute( 'selected', 'selected' );
			}
			$select->appendChild( $option );
		}
	}
}
