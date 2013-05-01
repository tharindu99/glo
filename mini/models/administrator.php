<?php
class administrator{
	private $username;
	private $password;
	private $isActive;
	
	function __construct(){}
	
	function setUsername($username){
		$this->username = $username;
	}
	
	function getUsername(){
		return $this->username;
	}
	
	function setPassword($password){
		$this->password = $password;
	}
	
	function getPassword(){
		return $this->password;
	}
	
	function setIsActive($isActive){
		$this->isActive = $isActive;
	}
	
	function getIsActive(){
		return $this->isActive;
	}
	
	static function connectToDBEngineAndSelectDB(){
		$connection = mysql_connect('localhost', 'root', '') or die(mysql_error());
		mysql_select_db('studentimsdb', $connection) or die(mysql_error());
	}
	
	function select($username){
		self::connectToDBEngineAndSelectDB();
		$selectQuery = "SELECT * FROM administrator WHERE username = '".$username."'";
		$queryResult = mysql_query($selectQuery) or die(mysql_error());
		$numRows = mysql_num_rows($queryResult);
		
		if($numRows == 1){
			$resultsRow = mysql_fetch_array($queryResult);
			
			$this->setUsername($resultsRow[0]);
			$this->setPassword($resultsRow[1]);
			$this->setIsActive($resultsRow[2]);
			
			return 1;
		}else{
			return 0;
		}
	}
}

?>