<?php
/**
 * Part of the Vaseman Prototype System files.
 *
 * @copyright  Copyright (C) 2013 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace DI;

use Slim\Helper\Set as SlimHelper;

/**
 * A helper container
 */
class Helper extends SlimHelper
{
    /**
     * Get data value with key
     *
     * @param  string $key     The data key
     * @param  mixed  $default The value to return if data key does not exist
     * @return mixed           The data value, or the default value
     */
    public function get($key, $default = null)
    {
        if (!$this->has($key) && !$default)
        {
            $class = 'Helper\\' . ucfirst($key);
            
            $this->singleton($key, function($this) use($class)
            {
                return new $class($this);
            });
        }
        
        return parent::get($key, $default);
    }

	/**
	 * __isset
	 *
	 * @param $key
	 *
	 * @return bool
	 */
	public function __isset($key)
    {
        return true;
    }
    
    /**
     * show description
     *
     * @param  string
     * @param  string
     * @param  string
     *
     * @return  string  showReturn
     *
     * @since  1.0
     */
    public function show($data)
    {
        return \show($data);
    }
}
