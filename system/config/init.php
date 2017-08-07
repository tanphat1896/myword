<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 28/7/2017
 * Time: 10:50 PM
 */
if (!defined('SYSTEM_PATH'))
	die('Bad request!');

$haveSSL = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443;
$header = $haveSSL ? "https://" : "http://";

return array(
	'module' => 'word',
	'action' => 'index',
	'baseUrl' => $header . 'localhost/MyWord'
);