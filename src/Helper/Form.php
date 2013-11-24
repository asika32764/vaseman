<?php

namespace Helper;

use DI\BaseHelper as Helper;
use Joomla\Utilities\ArrayHelper;

class Form extends Helper
{
	public function getText($name, $label, $value = '', $option = array())
	{
		$left           = ArrayHelper::getValue($option, 'left', 3);
		$right          = ArrayHelper::getValue($option, 'right', 7);
		$placeholder    = ArrayHelper::getValue($option, 'placeholder', $label);
		$disabled       = ArrayHelper::getValue($option, 'disabled') ? 'disabled' : '';
		$readonly       = ArrayHelper::getValue($option, 'readonly') ? 'readonly' : '';

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

	public function getInput($name, $value, $placeholder, $disabled, $readonly)
	{
		return <<<INPUT
<input type="text" class="form-control" id="input-{$name}" value="{$value}" placeholder="{$placeholder}" {$disabled} {$readonly} />
INPUT;
	}

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
