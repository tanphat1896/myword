<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 28/7/2017
 * Time: 10:53 PM
 */
if (!defined('SYSTEM_PATH'))
	die('Bad request!');
class BaseDataProvider {
	private $dataProvider;

	protected function __construct() {
		$this->dataProvider = MySQLConnection::getInstance();
	}

	protected function escapeString($str){
		return $this->dataProvider->escapeString($str);
	}

	protected function getAllRow($sql){
		return $this->dataProvider->getAllRow($sql);
	}

	protected function getRow($sql){
		return $this->dataProvider->getRow($sql);
	}

	protected function insertData($table, $data){
		$fields = '';
		$values = '';
		foreach ($data as $field => $value) {
			$fields .= ", $field";
			$values .= ", '" . $this->escapeString($value) . "'";
		}
		$fields = trim($fields, ',');
		$values = trim($values, ',');
		$sql = "insert into $table($fields) values($values)";
		return $this->dataProvider->exec($sql);
	}

	protected function getLastInsertId(){
		return $this->dataProvider->getLastInsertId();
	}

	protected function updateData($table, $data, $where = 1){
		$updateFields = '';
		foreach ($data as $field => $value) {
			$updateFields .= ", $field = '" . $this->escapeString($value) . "'";
		}
		$updateFields = trim($updateFields, ",");
		$sql = "update $table set $updateFields where $where";
		return $this->dataProvider->exec($sql);
	}

	protected function removeData($table, $where = 1){
		$sql = "delete from $table where $where";
		return $this->dataProvider->exec($sql);
	}
}