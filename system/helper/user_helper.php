<?php
/**
 * Created by PhpStorm.
 * User: TanPhat
 * Date: 3/8/2017
 * Time: 4:22 PM
 */

if (!defined('SYSTEM_PATH'))
	die('Bad request!');

function login(){
	setSession('userToken', true);
}

function loggedIn(){
	return !empty(getSession('userToken'));
}

function logout(){
	removeSession('userToken');
}