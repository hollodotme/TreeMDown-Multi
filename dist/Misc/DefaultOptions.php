<?php
/**
 * Default options override
 *
 * @author hollodotme
 */

namespace hollodotme\TreeMDownMulti\Misc;

/**
 * Class DefaultOptions
 *
 * @package hollodotme\TreeMDownMulti\Misc
 */
class DefaultOptions extends \hollodotme\TreeMDown\Misc\DefaultOptions
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();

		$this->set( Opt::GITHUB_RIBBON_URL, 'https://github.com/TreeMDown-Multi' );
	}
}
