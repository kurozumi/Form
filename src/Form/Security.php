<?php

namespace Form;

class Security
{
	/**
	 * HTMLエンティティ化
	 * 
	 * @param string $string
	 * @return mixed
	 */
	public static function htmlspecialchars($string)
	{
		if(is_array($string))
		{
			foreach($string as &$value)
			{
				htmlspecialchars($value, ENT_QUOTES);
			}
			return $string;
		}
		else
		{
			return htmlspecialchars($string, ENT_QUOTES);
		}
	}
}
