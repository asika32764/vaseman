<?php
/**
 * Part of the Vaseman Prototype System files.
 *
 * @copyright  Copyright (C) 2013 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Vaseman\Helper;

use Windwalker\Core\View\Helper\AbstractHelper;
use Windwalker\Utilities\ArrayHelper;

/**
 * Class Form
 *
 * @package Helper
 */
class FormHelper extends AbstractHelper
{
	/**
	 * getText
	 *
	 * @param string $name
	 * @param string $label
	 * @param string $value
	 * @param array  $option
	 *
	 * @return  string
	 */
	public function getText($name, $label, $value = '', $option = array())
	{
		$left        = ArrayHelper::getValue($option, 'left', 3);
		$right       = ArrayHelper::getValue($option, 'right', 7);
		$placeholder = ArrayHelper::getValue($option, 'placeholder', $label);
		$disabled    = ArrayHelper::getValue($option, 'disabled') ? 'disabled' : '';
		$readonly    = ArrayHelper::getValue($option, 'readonly') ? 'readonly' : '';

		return <<<TEXT
<div class="form-group">
    <div class="col-lg-{$left} control-label">
        <label for="input-{$name}">{$label}</label>
    </div>
    <div class="col-lg-{$right}">
        {$this->getInput($name, $value, $placeholder, $disabled, $readonly)}
    </div>
</div>
TEXT;
	}

	/**
	 * getBool
	 *
	 * @param string $name
	 * @param string $label
	 * @param string $value
	 * @param array  $option
	 *
	 * @return  string
	 */
	public function getBool($name, $label, $value, $options, $option = array())
	{
		$left           = ArrayHelper::getValue($option, 'left', 3);
		$right          = ArrayHelper::getValue($option, 'right', 7);

		$yes          = ArrayHelper::getValue($options, 0, 'Yes');
		$no           = ArrayHelper::getValue($options, 1, 'No');

		$active1 = $value == 1 ? 'active' : '';
		$active2 = $value == 0 ? 'active' : '';

		return <<<LIST
<div class="form-group">
    <div class="col-lg-{$left} control-label">
        <label for="input-{$name}">{$label}</label>
    </div>
    <div class="col-lg-{$right}">
		<div class="btn-group" data-toggle="buttons">
		    <label class="btn btn-default radio-yes {$active1}">
		        <input type="radio" name="options" id="{$name}-yes"> {$yes}
		    </label>
		    <label class="btn btn-default radio-no {$active2}">
		        <input type="radio" name="options" id="{$name}-no"> {$no}
		    </label>
		</div>
    </div>
</div>
LIST;
	}

	/**
	 * getList
	 *
	 * @param string $name
	 * @param string $label
	 * @param string $value
	 * @param array  $option
	 *
	 * @return  string
	 */
	public function getList($name, $label, $value, $options, $option = array())
	{
		$left           = ArrayHelper::getValue($option, 'left', 3);
		$right          = ArrayHelper::getValue($option, 'right', 7);
		$placeholder    = ArrayHelper::getValue($option, 'placeholder', $label);
		$disabled       = ArrayHelper::getValue($option, 'disabled') ? 'disabled' : '';
		$readonly       = ArrayHelper::getValue($option, 'readonly') ? 'readonly' : '';

		return <<<LIST
<div class="form-group">
    <div class="col-lg-{$left} control-label">
        <label for="input-{$name}">{$label}</label>
    </div>
    <div class="col-lg-{$right}">
        <select name="{$name}" id="input-{$name}" class="form-control" placeholder="{$placeholder}" {$disabled} {$readonly} >
            {$this->getOptions($value, $options)}
        </select>
    </div>
</div>
LIST;
	}

	/**
	 * getCalendar
	 *
	 * @param string $name
	 * @param string $label
	 * @param string $value
	 * @param array  $option
	 *
	 * @return  string
	 */
	public function getCalendar($name, $label, $value = '', $option = array())
	{
		$left           = ArrayHelper::getValue($option, 'left', 3);
		$right          = ArrayHelper::getValue($option, 'right', 7);
		$placeholder    = ArrayHelper::getValue($option, 'placeholder', $label);
		$disabled       = ArrayHelper::getValue($option, 'disabled') ? 'disabled' : '';
		$readonly       = ArrayHelper::getValue($option, 'readonly') ? 'readonly' : '';

		$value = $value ?: date('Y-m-d H:i:s');

		return <<<CAL
<div class="form-group">
    <label for="input-category" class="col-lg-{$left} control-label">{$label}</label>

    <div class="col-lg-{$right}">
        <div class="input-group">
            {$this->getInput($name, $value, $placeholder, $disabled, $readonly)}

            <span class="input-group-btn">
                <button class="btn btn-default" type="button"><i class="glyphicon glyphicon-calendar"></i></button>
            </span>
        </div>
    </div>
</div>
CAL;
	}

	/**
	 * getUser
	 *
	 * @param string $name
	 * @param string $label
	 * @param string $value
	 * @param array  $option
	 *
	 * @return  string
	 */
	public function getUser($name, $label, $value = '', $option = array())
	{
		$left           = ArrayHelper::getValue($option, 'left', 3);
		$right          = ArrayHelper::getValue($option, 'right', 7);
		$placeholder    = ArrayHelper::getValue($option, 'placeholder', $label);
		$disabled       = ArrayHelper::getValue($option, 'disabled') ? 'disabled' : '';
		$readonly       = ArrayHelper::getValue($option, 'readonly') ? 'readonly' : '';

		return <<<USER
<div class="form-group">
    <label for="input-category" class="col-lg-{$left} control-label">{$label}</label>

    <div class="col-lg-{$right}">
        <div class="input-group">
            {$this->getInput($name, $value, $placeholder, $disabled, $readonly)}

            <span class="input-group-btn">
                <button class="btn btn-primary" type="button"><i class="glyphicon glyphicon-user"></i></button>
            </span>
        </div>
    </div>
</div>
USER;
	}

	/**
	 * getInput
	 *
	 * @param string  $name
	 * @param string  $value
	 * @param string  $placeholder
	 * @param boolean $disabled
	 * @param boolean $readonly
	 *
	 * @return  string
	 */
	public function getInput($name, $value, $placeholder, $disabled, $readonly)
	{
		return <<<INPUT
<input type="text" class="form-control" id="input-{$name}" value="{$value}" placeholder="{$placeholder}" {$disabled} {$readonly} />
INPUT;
	}

	/**
	 * getOptions
	 *
	 * @param string $value
	 * @param array  $options
	 *
	 * @return  string
	 */
	public function getOptions($value = '', $options)
	{
		$html = array();

		foreach ($options as $key => $option)
		{
			$selected = $value == $key ? 'selected' : '';

			$html[] = "<option value=\"{$value}\" {$selected}>{$option}</option>";
		}

		return implode("\n", $html);
	}
}
