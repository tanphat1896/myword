<?php
/**
 * Created by PhpStorm.
 * User: ngtanphat
 * Date: 31/7/2017
 * Time: 4:59 PM
 */
if (!defined('SYSTEM_PATH'))
	die('Bad request!');
$baseUrl = isset($GLOBALS['config']['baseUrl']) ? $GLOBALS['config']['baseUrl']: 'http://localhost/MyWord';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>My word</title>
	<script src="<?php echo $baseUrl; ?>/public/js/jquery-3.2.1.min.js"></script>
	<script src="<?php echo $baseUrl; ?>/public/bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="<?php echo $baseUrl; ?>/public/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/public/css/style.css">
	<script src="<?php echo $baseUrl; ?>/public/js/word_process.js"></script>
    <script src="<?php echo $baseUrl; ?>/public/js/search_word_process.js"></script>
</head>
<body>
<div class="wrapper clearfix">
	<!--thanh tiêu đề-->
	<nav class="container-fluid navigator">
		<div class="col-sm-6 navigator-title">
			<h5><strong>MyWord</strong> - Improve your vocabulary</h5>
		</div>
		<div class="col-sm-6 text-right nav-btn">
			<a href="#" class="active btn btn-sm"><strong>Words</strong></a>
			<a href="#" class="btn btn-sm"><strong>Phrases</strong></a>
			<a href="#" class="btn btn-sm" data-toggle="tooltip" title="Login" data-placement="auto">
				<span class="glyphicon glyphicon-log-in"></span>
			</a>
		</div>
	</nav>

