<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 28/7/2017
 * Time: 10:54 PM
 */
if (!defined('SYSTEM_PATH'))
	die('Bad request!');

class PhraseDataProvider extends BaseDataProvider {
	private $table = "phrases";

	public function __construct() {
		parent::__construct();
	}


}