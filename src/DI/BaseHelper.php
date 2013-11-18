<?php

namespace DI;

/**
 * A helper base class
 */
abstract class BaseHelper
{
	protected $helper;

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