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
		$GLOBALS['config'] = include_once SYSTEM_PATH . '/config/init.php';
		$GLOBALS['baseUrl'] = isset($GLOBALS['config']['baseUrl']) ? $GLOBALS['config']['baseUrl']: '';
		if (empty($GLOBALS['baseUrl']))
			die("Website not found!!");
		$GLOBALS['glConfig'] = include_once SYSTEM_PATH . '/config/gl_config.php';
		$GLOBALS['dbConfig'] = include_once SYSTEM_PATH . '/config/db_config.php';

		$defaultModule = isset($GLOBALS['config']['module']) ? $GLOBALS['config']['module']: 'word';
		$defaultAction = isset($GLOBALS['config']['action']) ? $GLOBALS['config']['action']: 'index';

		$module = empty($_GET['m']) ? $defaultModule: $_GET['m'];
		$action = empty($_GET['a']) ? $defaultAction: $_GET['a'];

		$path = MODULE_PATH . "/{$module}/{$action}.php";
		if (file_exists($path)){
			require_once SYSTEM_PATH . '/db/MySQLConnection.php';
			require_once SYSTEM_PATH . '/db/BaseDataProvider.php';
			require_once SYSTEM_PATH . '/db/WordDataProvider.php';
			require_once SYSTEM_PATH . '/lib/session.php';
			require_once SYSTEM_PATH . '/helper/user_helper.php';
			require_once SYSTEM_PATH . '/helper/common_helper.php';
			require_once $path;
		} else {
			die("Bad request!");
		}
	}
}