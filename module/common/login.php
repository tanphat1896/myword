<?php
/**
 * Created by PhpStorm.
 * User: TanPhat
 * Date: 3/8/2017
 * Time: 4:21 PM
 */

if (!defined('SYSTEM_PATH'))
	die('Bad request!');
$username = getPOSTValue('username');
$password = md5(getPOSTValue('password'));

if ($username == $GLOBALS['dbConfig']['username'] && $password == $GLOBALS['dbConfig']['password']){
	login();
	redirect($GLOBALS['baseUrl']);
} else {
	echo "<script>alert('Thất bại'); window.location = '" . $GLOBALS['baseUrl'] . "'</script>";
	exit();
}
?>

