<?php
/**
 * TreeMDown override
 *
 * @author hollodotme
 */

namespace hollodotme\TreeMDownMulti;

use hollodotme\TreeMDownMulti\Misc\DefaultOptions;
use hollodotme\TreeMDownMulti\Misc\Opt;

/**
 * Class TreeMDown
 *
 * @package hollodotme\TreeMDownMulti
 */
class TreeMDown extends \hollodotme\TreeMDown\TreeMDown
{
	/**
	 * Constructor
	 *
	 * @param string $root_dir Root directory
	 */
	public function __construct( $root_dir = '.' )
	{
		parent::__construct( $root_dir );

		$this->_options = new DefaultOptions();
		$this->_options->set( Opt::DIR_ROOT, realpath( strval( $root_dir ) ) );
	}

	/**
	 * Prepare the options
	 */
	protected function _prepareOptions()
	{
		parent::_prepareOptions();

		// Base params override
		$base_params          = $this->getOptions()->get( Opt::BASE_PARAMS );
		$base_params['tmd_t'] = $this->getOptions()->get( Opt::TREE_CURRENT );

		$this->getOptions()->set( Opt::BASE_PARAMS, $base_params );
	}
}
