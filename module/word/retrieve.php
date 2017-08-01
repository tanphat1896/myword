<?php
/**
 * Created by PhpStorm.
 * User: ngtanphat
 * Date: 31/7/2017
 * Time: 6:26 PM
 */
if (!defined('SYSTEM_PATH'))
	die('Bad request!');

$keyword = empty($_GET['key']) ? '': $_GET['key'];
if (empty($keyword))
	die('{"success":"0"}');

require_once SYSTEM_PATH . '/db/WordDataProvider.php';
$wordDP = WordDataProvider::getInstance();

$fullWord = $wordDP->getFullWord($keyword);
die(json_encode(array(
	"success" => 1,
	"keyword" => $keyword,
	"data" => $fullWord
)));