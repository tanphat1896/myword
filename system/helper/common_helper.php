<?php
/**
 * Created by PhpStorm.
 * User: TanPhat
 * Date: 2/8/2017
 * Time: 12:40 AM
 */
if (!defined('SYSTEM_PATH'))
	die('Bad request!');

function getPOSTValue($key){
	return isset($_POST[$key]) ? $_POST[$key]: false;
}

function getGETValue($key){
	return isset($_GET[$key]) ? $_GET[$key]: false;
}

function isSubmit($key){
	$value = getPOSTValue("request_name");
	return !empty($value) && $value === $key;
}

function redirect($url){
	header("Location: $url");
	exit();
}