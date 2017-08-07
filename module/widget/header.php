<?php
/**
 * Created by PhpStorm.
 * User: ngtanphat
 * Date: 31/7/2017
 * Time: 4:59 PM
 */
if (!defined('SYSTEM_PATH'))
	die('Bad request!');
$baseUrl = $GLOBALS['baseUrl'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo $baseUrl; ?>/public/favicon.png">
	<title>My word</title>
	<script src="<?php echo $baseUrl; ?>/public/js/jquery-3.2.1.min.js"></script>
	<script src="<?php echo $baseUrl; ?>/public/bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="<?php echo $baseUrl; ?>/public/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/public/css/style.css">
</head>
<body>
<div class="wrapper clearfix">
	<!--thanh tiêu đề-->
	<nav class="container-fluid navigator">
		<div class="col-sm-6 navigator-title">
			<h5><strong>MyWord</strong> - Improve your vocabulary</h5>
		</div>
		<div class="col-sm-6 text-right nav-btn">
			<a href="<?php echo $baseUrl; ?>" data-toggle="tooltip" title="Word and phrase"
               data-placement="auto" class="btn btn-sm">
                <strong>W&amp;P</strong>
            </a>
			<a href="<?php echo $baseUrl; ?>?m=grammar" class="btn btn-sm"><strong>Grammar</strong></a>
            <?php
            if (loggedIn()){
				echo '<a href="?m=common&a=logout" class="btn btn-sm">
				        <span class="glyphicon glyphicon-log-out"></span> Logout
			          </a>';
            } else {
                echo '<a href="#modal-login" data-toggle="modal" class="btn btn-sm">
				        <span class="glyphicon glyphicon-log-in"></span> Login
			          </a>';
            }
            ?>
		</div>
	</nav>

