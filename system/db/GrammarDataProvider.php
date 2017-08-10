<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 28/7/2017
 * Time: 10:54 PM
 */
if (!defined('SYSTEM_PATH'))
	die('Bad request!');

class GrammarDataProvider extends BaseDataProvider {
	private static $grammarDP = null;
	private $table = "tb_grammar";
	private $link_table = "tb_grammarcontent";

	protected function __construct() {
		parent::__construct();
	}

	public static function getInstance(){
		if (empty(self::$grammarDP))
			self::$grammarDP = new GrammarDataProvider();
		return self::$grammarDP;
	}

	public function getListArticleTitle(){
		$sql = "select * from {$this->table} order by title";
		return $this->getAllRow($sql);
	}

	public function getArticleTitle($articleId){
		$sql = "select title from $this->table where id = $articleId";
		$row = $this->getRow($sql);
		return empty($row) ? "": $row['title'];
	}

	public function getArticleContent($articleId){
		$sql = "select content from $this->link_table where titleId = $articleId";
		$row = $this->getRow($sql);
		return empty($row) ? "": $row['content'];
	}

	public function addNewArticle($title, $content){
		if ($this->insertData($this->table, array('title' => $title))){
			$titleId = $this->getLastInsertId();
			$rs = $this->insertData($this->link_table, array('titleId' => $titleId, 'content' => $content));
			if (!empty($rs))
				return $titleId;
		}
		return false;
	}

	public function updateArticle($id, $title, $content){
		if ($this->updateData($this->table, array('title' => $title), "id = $id")){
			return $this->updateData($this->link_table, array('content' => $content), "titleId = $id");
		}
		return false;
	}
}