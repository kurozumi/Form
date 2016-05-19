<?php

namespace Form;

use Form\Security;

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
	
	public static function create()
	{
		return self::getInstance();
	}

	public static function createConfirm()
	{
		$instance = self::create();
		
		$_SESSION = Security::htmlspecialchars($_POST) OR self::redirect();

		return $instance;
	}

	public static function createComplete()
	{
		$instance = self::create();
		
		if (!$_SESSION)
			self::redirect();
		
		return $instance;
	}
	
	public static function redirect()
	{
		header("Location: ./");
		exit();
	}
	
	public static function setErrors($errors = array())
	{
		$_SESSION['errors'] = $errors;
	}

	public static function message($field)
	{
		return isset($_SESSION['errors'][$field]) ? $_SESSION['errors'][$field] : "";
	}
}
