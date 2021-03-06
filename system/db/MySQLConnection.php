<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 28/7/2017
 * Time: 10:52 PM
 */
if (!defined('SYSTEM_PATH'))
	die('Bad request!');

class MySQLConnection {
	private static $provider = null;
	private $con;
	private function __construct() {
		$host = empty($GLOBALS['dbConfig']['host']) ? 'localhost': $GLOBALS['dbConfig']['host'];
		$user = empty($GLOBALS['dbConfig']['user']) ? 'root': $GLOBALS['dbConfig']['user'];
		$pass = empty($GLOBALS['dbConfig']['pass']) ? '': $GLOBALS['dbConfig']['pass'];
		$dbName = empty($GLOBALS['dbConfig']['dbName']) ? 'myword': $GLOBALS['dbConfig']['dbName'];
		$this->con = new mysqli($host, $user, $pass, $dbName)
			or die('Connection failed');
		$this->con->query('set names utf8');
	}

	public static function getInstance(){
		if (empty(self::$provider)){
			self::$provider = new MySQLConnection();
		}
		return self::$provider;
	}

	public function escapeString($str){
		return $this->con->real_escape_string($str);
	}

	public function getRow($sql){
		$mysqliResult = $this->con->query($sql);
		if ($mysqliResult->num_rows > 0)
			return $mysqliResult->fetch_assoc();
		return false;
	}

	public function getAllRow($sql){
		$mysqliResult = $this->con->query($sql);
		$allRows = array();
		while ($row = $mysqliResult->fetch_assoc())
				$allRows[] = $row;
		return $allRows;
	}

	public function getLastInsertId(){
		return $this->con->insert_id;
	}

	public function exec($sql){
		return $this->con->query($sql);
	}
}