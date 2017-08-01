<?php
/**
 * Created by PhpStorm.
 * User: ngtanphat
 * Date: 31/7/2017
 * Time: 4:57 PM
 */
if (!defined('SYSTEM_PATH'))
	die('Bad request!');

$type = empty($_GET['type']) ? 'norm': $_GET['type'];

if ($type === "norm"){

}

if ($type === "search"){
	$str = empty($_GET['str']) ? "": $_GET['str'];

	if (empty($str))
		die(die(json_encode(array(
			"success" => 1,
			"data"=> array()
		))));

	require_once SYSTEM_PATH . '/db/WordDataProvider.php';
	$wordDP = WordDataProvider::getInstance();

	$listWord = $wordDP->searchWord($str);

	die(json_encode(array(
		"success" => 1,
		"data"=> $listWord
	)));
}