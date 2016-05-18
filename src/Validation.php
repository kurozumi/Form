<?php
namespace Kurozumi\Form;

class Validation
{

	public static function required($key)
	{
		return is_array($_SESSION[$key]) ?
			(bool) (count($_SESSION[$key]) === count(array_filter($_SESSION[$key], 'strlen'))) : (trim($_SESSION[$key]) !== '');
	}

	public static function email($key)
	{
		$str = $_SESSION[$key];
		if (function_exists('idn_to_ascii') && $atpos = strpos($str, '@'))
		{
			$str = substr($str, 0, ++$atpos) . idn_to_ascii(substr($str, $atpos));
		}
		return (bool) filter_var($str, FILTER_VALIDATE_EMAIL);
	}

	public static function phone($key)
	{
		if (is_array($_SESSION[$key]) && !array_filter($_SESSION[$key], "strlen"))
			return true;

		$phone = is_array($_SESSION[$key]) ? implode("-", $_SESSION[$key]) : $_SESSION[$key];
		return (bool) preg_match("/^\d{2,5}\-\d{1,4}\-\d{1,4}$/", $phone);
	}

	public static function postalcode($key)
	{
		$postalcode = is_array($_SESSION[$key]) ? implode("-", $_SESSION[$key]) : $_SESSION[$key];
		return (bool) preg_match("/^\d{3}-\d{4}$|^\d{3}-\d{2}$|^\d{3}$/", $postalcode);
	}

	public static function set_errors($errors = array())
	{
		$_SESSION['errors'] = $errors;
	}

	public static function form_error($key)
	{
		return isset($_SESSION['errors'][$key]) ? $_SESSION['errors'][$key] : "";
	}

}
