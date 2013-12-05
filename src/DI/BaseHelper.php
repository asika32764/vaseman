<?php
/**
 * Part of the Vaseman Prototype System files.
 *
 * @copyright  Copyright (C) 2013 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace DI;

/**
 * A helper base class
 */
abstract class BaseHelper
{
	/**
	 * @var Helper
	 */
	protected $helper;

	/**
	 * Constructor.
	 *
	 * @param null $helper
	 */
	public function __construct($helper = null)
	{
		$this->helper = $helper;
	}

    /**
     * __invoke description
     *
     * @param  string
     * @param  string
     * @param  string
     *
     * @return  string  __invokeReturn
     *
     * @since  1.0
     */
    public function __invoke($helper = null)
    {
        return $this;
    }
}
