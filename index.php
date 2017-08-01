<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 28/7/2017
 * Time: 10:30 PM
 */

define('SYSTEM_PATH', __DIR__ . '/system');
define('MODULE_PATH', __DIR__ . '/module');
define('PUBLIC_PATH', __DIR__ . '/public');

require_once SYSTEM_PATH . '/core/Bootstrap.php';

Bootstrap::run();
