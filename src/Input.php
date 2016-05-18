<?php
namespace Kurozumi;

class Input
{

	public static function value($key, $index = null)
	{
		if (isset($_SESSION[$key]))
		{
			if (is_array($_SESSION[$key]) && !is_null($index))
				return isset($_SESSION[$key][$index]) ? $_SESSION[$key][$index] : "";

			return $_SESSION[$key];
		}

	}

	public static function selected($key, $value, $index = 0)
	{
		if (isset($_SESSION[$key]))
		{
			if (is_array($_SESSION[$key]) && isset($_SESSION[$key][$index]))
				return ($_SESSION[$key][$index] == $value) ? ' selected="selected"' : '';

			return ($_SESSION[$key] == $value) ? ' selected="selected"' : '';
		}

	}

	public static function checked($key, $value)
	{
		if (isset($_SESSION[$key]))
		{
			if (is_array($_SESSION[$key]))
			{
				foreach ($_SESSION[$key] as $val)
				{
					if ($val == $value)
						return ' checked="checked"';
				}
			}

			return ($_SESSION[$key] == $value) ? 'checked="checked"' : '';
		}

	}
}
