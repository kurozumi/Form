<?php

namespace Form;

class Validation
{
	/**
	 * バリデーションルールの設定
	 * 
	 * @param string $field
	 * @param string $rules
	 * @return boolean
	 */
	public function setRules($field, $rules = array())
	{
		if (!isset($_SESSION[$field]))
			return false;

		if (!is_string($rules))
		{
			return false;
		}

		$rules = preg_split('/\|(?![^\[]*\])/', $rules);

		$required = in_array('required', $rules) ? true : false;

		foreach ($rules as $rule)
		{
			if (preg_match('/(.*?)\[(.*)\]/', $rule, $match))
			{
				$rule = $match[1];
				$param = $match[2];


				if (self::{$rule}($field, $param) === false)
					return ($required === false && empty($_SESSION[$field])) ? true : false;
			}
			else
			{
				if (self::{$rule}($field) === false)
					return ($required === false && empty($_SESSION[$field])) ? true : false;
			}
		}

		return true;

	}

	/**
	 * 必須チェック
	 * 
	 * @param string $field
	 * @return boolean
	 */
	protected static function required($field)
	{
		return is_array($_SESSION[$field]) ?
				(bool) (count($_SESSION[$field]) === count(array_filter($_SESSION[$field], 'strlen'))) : (trim($_SESSION[$field]) !== '');

	}

	/**
	 * 数値チェック
	 * 
	 * @param string $field
	 * @return boolean
	 */
	protected static function numeric($field)
	{
		if (!isset($_SESSION[$field]))
			return false;

		return (bool) preg_match('/^[\-+]?[0-9]*\.?[0-9]+$/', $_SESSION[$field]);

	}

	/**
	 * 最小文字数チェック
	 * 
	 * @param string $field
	 * @param int $val
	 * @return boolean
	 */
	protected static function min_length($field, $val)
	{
		if (!is_numeric($val))
		{
			return false;
		}

		return (bool) ($val <= mb_strlen($_SESSION[$field]));

	}

	/**
	 * 最大文字数チェック
	 * 
	 * @param sting $field
	 * @param int $val
	 * @return boolean
	 */
	protected static function max_length($field, $val)
	{
		if (!is_numeric($val))
		{
			return false;
		}

		return (bool) ($val >= mb_strlen($_SESSION[$field]));

	}

	/**
	 * 文字数チェック
	 * 
	 * @param string $field
	 * @param int $val
	 * @return boolean
	 */
	public function exact_length($field, $val)
	{
		if (!is_numeric($val))
		{
			return false;
		}

		return (bool) (mb_strlen($_SESSION[$field]) === (int) $val);

	}

	/**
	 * メールアドレスチェック
	 * 
	 * @param string $field
	 * @return boolean
	 */
	protected static function email($field)
	{
		if (!isset($_SESSION[$field]))
			return false;

		if (function_exists('idn_to_ascii') && $atpos = strpos($_SESSION[$field], '@'))
		{
			$str = substr($str, 0, ++$atpos) . idn_to_ascii(substr($_SESSION[$field], $atpos));
		}
		return (bool) filter_var($_SESSION[$field], FILTER_VALIDATE_EMAIL);

	}

	/**
	 * 電話番号チェック
	 * 
	 * @param string $field
	 * @return boolean
	 */
	protected static function phone($field)
	{
		if (is_array($_SESSION[$field]) && !array_filter($_SESSION[$field], "strlen"))
			return true;

		$phone = is_array($_SESSION[$field]) ? implode("-", $_SESSION[$field]) : $_SESSION[$field];
		return (bool) preg_match("/^\d{2,5}\-\d{1,4}\-\d{1,4}$/", $phone);

	}

	/**
	 * 郵便番号チェック
	 * 
	 * @param string $field
	 * @return boolean
	 */
	protected static function postalcode($field)
	{
		$postalcode = is_array($_SESSION[$field]) ? implode("-", $_SESSION[$field]) : $_SESSION[$field];
		return (bool) preg_match("/^\d{3}-\d{4}$|^\d{3}-\d{2}$|^\d{3}$/", $postalcode);

	}

}
