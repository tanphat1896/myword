<?php
/**
 * Created by PhpStorm.
 * User: ngtanphat
 * Date: 31/7/2017
 * Time: 4:57 PM
 */
if (!defined('SYSTEM_PATH'))
	die('Bad request!');

require_once SYSTEM_PATH . '/helper/common_helper.php';
require_once SYSTEM_PATH . '/db/WordDataProvider.php';
$wordDP = WordDataProvider::getInstance();

$type = getGETValue('type');

if ($type === "norm"){
	$pagerConfig = isset($GLOBALS['glConfig']['pagination']) ? $GLOBALS['glConfig']['pagination']: false;
	if (empty($pagerConfig))
		die('{"success": "0"}');

	$currentPage = getGETValue('p');
	if (empty($currentPage))
		$currentPage = 1;

	$currentPage++;

	$limit = isset($pagerConfig['limit']) ? (int)$pagerConfig['limit']: 0;
	$recordStart = ($currentPage - 1)*$limit;

	$listWord = $wordDP->getListWord($recordStart, $limit);

	die(json_encode(array(
		"success" => 1,
		"page" => ((count($listWord) < $limit) ? -1: $currentPage),
		"data"=> $listWord
	)));
}

if ($type === "search"){
	$str = empty($_GET['str']) ? "": $_GET['str'];

	if (empty($str))
		die(die(json_encode(array(
			"success" => 1,
			"data"=> array()
		))));
	$listWord = $wordDP->searchWord($str);
	die(json_encode(array(
		"success" => 1,
		"data"=> $listWord
	)));
}