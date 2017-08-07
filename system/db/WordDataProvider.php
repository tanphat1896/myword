<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 28/7/2017
 * Time: 10:52 PM
 */
if (!defined('SYSTEM_PATH'))
	die('Bad request!');

class WordDataProvider extends BaseDataProvider {
	private static $wordDp = null;
	private $table = "tb_word";
	private $linkTable = "tb_wordmeaning";

	protected function __construct() {
		parent::__construct();
	}

	public static function getInstance(){
		if (empty(self::$wordDp))
			self::$wordDp = new WordDataProvider();
		return self::$wordDp;
	}

	public function getTotalWord(){
		$sql = "select count(*) as total from " . $this->table;
		return $this->getRow($sql)['total'];
	}

	/**
	 * Lấy từ trong bảng
	 * @param $keyword
	 * @return array|bool
	 */
	public function getWord($keyword){
		$sql = "select * from " . $this->table . " where keyword='" . $this->escapeString($keyword) . "'";
		return $this->getRow($sql);
	}

	/**
	 * Lấy từ kèm nghĩa
	 * @param $keyword
	 * @return array|bool
	 */
	public function getFullWord($keyword){
		$sql = "select t.id as id, pronunciation, explanation 
				from {$this->table} t join {$this->linkTable} lt on t.id = lt.wid 
				where keyword='" . $this->escapeString($keyword) . "'";
		return $this->getRow($sql);
	}

	/**
	 * Lấy danh sách từ có chứa các ký tự trong inputChar
	 * @param $inputChar
	 * @return array
	 */
	public function searchWord($inputChar){
		$filter = '%';
		for ($i = 0; $i < strlen($inputChar); $i++){
			$filter .= "{$inputChar[$i]}%";
		}
		$sql = "select * from " . $this->table . " where keyword like '$filter'";
		return $this->getAllRow($sql);
	}

//	public function searchWord($inputChar){
//		$sql = "select * from " . $this->table . " where keyword like '$inputChar%'";
//		return $this->getAllRow($sql);
//	}

	/**
	 * Lấy hết từ trong bảng
	 * @param int $idStart
	 * @param int $limit
	 * @return array
	 */
	public function getListWord($idStart = 0, $limit = 0){
		$sql = "select * from " . $this->table;
		if ($limit > 0)
			$sql .= " limit $idStart, $limit";
		return $this->getAllRow($sql);
	}

	public function addNewWord($keyword, $pronunciation, $explanationJSON){
		$rs = $this->insertData($this->table, array('keyword' => $keyword));
		if (!empty($rs))
			return $this->insertData($this->linkTable, array('wid' => $this->getLastInsertId(),'pronunciation' => $pronunciation, 'explanation' => $explanationJSON));
		return false;
	}
}