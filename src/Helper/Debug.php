<?php

namespace Helper;

use DI\BaseHelper as Helper;

class Debug extends Helper
{
	/**
	 * recursive print variables and limit by level.
	 *
	 * @param   mixed  $data   The variable you want to dump.
	 * @param   int    $level  The level number to limit recursive loop.
	 *
	 * @since   1.0
	 *
	 * @return  string  Dumped data.
	 */
	function printRLevel($data, $level = 5)
	{
		static $innerLevel = 1;

		static $tabLevel = 1;

		$self = __FUNCTION__;

		$type       = gettype($data);
		$tabs       = str_repeat('    ', $tabLevel);
		$quoteTabes = str_repeat('    ', $tabLevel - 1);
		$output     = '';
		$elements   = array();

		$recursiveType = array('object', 'array');

		// Recursive
		if (in_array($type, $recursiveType))
		{
			// If type is object, try to get properties by Reflection.
			if ($type == 'object')
			{
				$output     = get_class($data) . ' ' . ucfirst($type);
				$ref        = new \ReflectionObject($data);
				$properties = $ref->getProperties();

				foreach ($properties as $property)
				{
					$property->setAccessible(true);

					$pType = $property->getName();

					if ($property->isProtected())
					{
						$pType .= ":protected";
					}
					elseif ($property->isPrivate())
					{
						$pType .= ":" . $property->class . ":private";
					}

					if ($property->isStatic())
					{
						$pType .= ":static";
					}

					$elements[$pType] = $property->getValue($data);
				}
			}
			// If type is array, just retun it's value.
			elseif ($type == 'array')
			{
				$output   = ucfirst($type);
				$elements = $data;
			}

			// Start dumping data
			if ($level == 0 || $innerLevel < $level)
			{
				// Start recursive print
				$output .= "\n{$quoteTabes}(";

				foreach ($elements as $key => $element)
				{
					$output .= "\n{$tabs}[{$key}] => ";

					// Increment level
					$tabLevel = $tabLevel + 2;
					$innerLevel++;

					$output  .= in_array(gettype($element), $recursiveType) ? $self($element, $level) : $element;

					// Decrement level
					$tabLevel = $tabLevel - 2;
					$innerLevel--;
				}

				$output .= "\n{$quoteTabes})\n";
			}
			else
			{
				$output .= "\n{$quoteTabes}*MAX LEVEL*\n";
			}
		}
		else
		{
			$output = $data;
		}

		return $output;
	}

	/**
	 * Dump Array or Object as tree node. If send multiple params in this method, this function will batch print it.
	 *
	 * @param   mixed $data Array or Object to dump.
	 *
	 * @internal param int $level The level number to limit recursive loop.
	 * @since    1.0
	 * @return  void
	 */
	function show($data)
	{
		$args = func_get_args();

		$last = array_pop($args);

		if (is_int($last))
		{
			$level = $last;
		}
		else
		{
			$level = 4;

			$args[] = $last;
		}

		// Dump Multiple values
		if (count($args) > 1)
		{
			$prints = array();

			$i = 1;

			foreach ($args as $arg)
			{
				$prints[] = "[Value " . $i . "]\n" . $this->printRLevel($arg, $level);
				$i++;
			}

			echo '<pre>' . implode("\n\n", $prints) . '</pre>';
		}
		else
		{
			// Dump one value.
			echo '<pre>' . $this->printRLevel($data, $level) . '</pre>';
		}
	}

}