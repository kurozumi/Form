<?php

namespace Kurozumi\Form;

class Form
{

	private static $instance;
	
	public function __construct()
	{
		session_start();
	}

	public static function getInstance()
	{
		if (!self::$instance)
			self::$instance = new self();

		return self::$instance;
	}

	public function __set($name, $class)
	{
		$this->{$name} = $class;
	}
	
	public static function form()
	{
		return self::getInstance();
	}

	public static function confirm()
	{
		$_SESSION = $_POST OR self::redirect();

		return self::getInstance();
	}

	public static function complete()
	{
		if (!$_SESSION)
			self::redirect();
		
		return self::getInstance();
	}
	
	public static function set_errors($errors)
	{
		$_SESSION['errors'] = $errors;
	}

	public static function redirect()
	{
		header("Location: ./");
		exit();
	}

}
