<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 28/7/2017
 * Time: 10:46 PM
 */
if (!defined('SYSTEM_PATH'))
	die('Bad request!');

class Bootstrap{
	public static function run(){
		require_once SYSTEM_PATH . '/db/MySQLConnection.php';
		require_once SYSTEM_PATH . '/db/BaseDataProvider.php';
		require_once SYSTEM_PATH . '/db/WordDataProvider.php';
		$GLOBALS['config'] = include_once SYSTEM_PATH . '/config/init.php';
		$defaultModule = isset($GLOBALS['config']['module']) ? $GLOBALS['config']['module']: 'word';
		$defaultAction = isset($GLOBALS['config']['action']) ? $GLOBALS['config']['action']: 'index';
		$module = empty($_GET['m']) ? $defaultModule: $_GET['m'];
		$action = empty($_GET['a']) ? $defaultAction: $_GET['a'];

		$path = MODULE_PATH . "/{$module}/{$action}.php";
		if (file_exists($path))
			require_once $path;
		else {
			die("Bad request!");
		}
	}
}