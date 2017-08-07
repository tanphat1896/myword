<?php
/**
 * Created by PhpStorm.
 * User: TanPhat
 * Date: 3/8/2017
 * Time: 4:32 PM
 */
if (!defined('SYSTEM_PATH'))
	die('Bad request!');

session_start();

function setSession($key, $value){
	$_SESSION[$key] = $value;
}

function getSession($key){
	return isset($_SESSION[$key]) ? $_SESSION[$key]: false;
}

function removeSession($key){
	unset($_SESSION[$key]);
}