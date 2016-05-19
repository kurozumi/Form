<?php
namespace Form;

class Input
{
	/**
	 * inputの値を取得
	 * 
	 * @param string $field
	 * @param int $index
	 * @return type
	 */
	public static function value($field, $index = null)
	{
		if (isset($_SESSION[$field]))
		{
			if (is_array($_SESSION[$field]) && !is_null($index))
				return isset($_SESSION[$field][$index]) ? $_SESSION[$field][$index] : "";

			return $_SESSION[$field];
		}

	}

	/**
	 * 
	 * @param string $field
	 * @param tystringpe $value
	 * @param int $index
	 * @return string
	 */
	public static function selected($field, $value, $index = 0)
	{
		if (isset($_SESSION[$field]))
		{
			if (is_array($_SESSION[$field]) && isset($_SESSION[$field][$index]))
				return ($_SESSION[$field][$index] == $value) ? ' selected="selected"' : '';

			return ($_SESSION[$field] == $value) ? ' selected="selected"' : '';
		}

	}

	/**
	 * 
	 * @param string $field
	 * @param string $value
	 * @return string
	 */
	public static function checked($field, $value)
	{
		if (isset($_SESSION[$field]))
		{
			if (is_array($_SESSION[$field]))
			{
				foreach ($_SESSION[$field] as $val)
				{
					if ($val == $value)
						return ' checked="checked"';
				}
			}

			return ($_SESSION[$field] == $value) ? 'checked="checked"' : '';
		}

	}
}
