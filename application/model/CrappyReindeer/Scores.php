<?php
class Scores{
	private $db;
	public function __construct(){
		Jumbee::App()->getConfig();
		$driver = Jumbee::getDataBaseDriver();
		Jumbee::App()->LoadDatabaseDriver();
		
		$this->db = new $driver;
		$this->db->connect();
	}

	public function GetScores($limit = null){
		
		$this->db->prepare("select * from `scores`");
		$this->db->query();
		return $this->db->fetch();
	}

	public function GetId($device){
		$this->db->prepare("select * from `uniqid` WHERE `device_id` = '".$device."'");
		$this->db->query();
		return $this->db->fetch();	
	}
}