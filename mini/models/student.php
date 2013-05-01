<?php
class student{
	private $ssn;
	private $name;
	private $age;
	private $year;
	private $insertedBy;
	
	function __construct(){}
	
	function setSsn($ssn){
		$this->ssn = $ssn;
	}
	
	function getSsn(){
		return $this->ssn;
	}
	
	function setName($name){
		$this->name = $name;
	}
	
	function getName(){
		return $this->name;
	}
	
	function setAge($age){
		$this->age = $age;
	}
	
	function getAge(){
		return $this->age;
	}
	
	function setYear($year){
		$this->year = $year;
	}
	
	function getYear(){
		return $this->year;
	}
	
	function setInsertedBy($insertedBy){
		$this->insertedBy = $insertedBy;
	}
	
	function getInsertedBy(){
		return $this->insertedBy;
	}
	
	static function connectToDBEngineAndSelectDB(){
		$connection = mysql_connect('localhost', 'root', '') or die(mysql_error());
		mysql_select_db('studentimsdb', $connection) or die(mysql_error());
	}
	
	function insert(){
		self::connectToDBEngineAndSelectDB();
		
		$ssn = $this->getSsn();
		$name = $this->getName();
		$age = $this->getAge();
		$year = $this->getYear();
		$insertedBy = $this->getInsertedBy();
			
		$insertQuery = "INSERT INTO student VALUES(".$ssn.", '".$name."', ".$age.", ".$year.", '".$insertedBy."')";
		mysql_query($insertQuery) or die(mysql_error());
	}
	
	function select($ssn){
		self::connectToDBEngineAndSelectDB();
		
		$selectQuery = "SELECT * FROM student WHERE ssn = ".$ssn;
		$queryResult = mysql_query($selectQuery) or die(mysql_error());
		$numRows = mysql_num_rows($queryResult);
		
		if($numRows == 1){
			$resultsRow = mysql_fetch_array($queryResult);
			
			$this->setSsn($resultsRow[0]);
			$this->setName($resultsRow[1]);
			$this->setAge($resultsRow[2]);
			$this->setYear($resultsRow[3]);
			$this->setInsertedBy($resultsRow[4]);
			
			return 1;
		}else{
			return 0;
		}
	}
	
	function update(){
		self::connectToDBEngineAndSelectDB();
		
		$ssn = $this->getSsn();
		$name = $this->getName();
		$age = $this->getAge();
		$year = $this->getYear();
			
		$updateQuery = "UPDATE student SET name = '".$name."', age = ".$age.", year = ".$year." WHERE ssn = ".$ssn;
		mysql_query($updateQuery) or die(mysql_error());
	}
	
	function delete(){
		self::connectToDBEngineAndSelectDB();
		
		$ssn = $this->getSsn();
		$deleteQuery = "DELETE FROM student WHERE ssn = ".$ssn;
		mysql_query($deleteQuery) or die(mysql_error());
	}
	
	function calculate_next_ssn(){
		self::connectToDBEngineAndSelectDB();
		
		$selectQuery = "SELECT MAX(ssn) FROM student";
		$queryResult = mysql_query($selectQuery) or die(mysql_error());
		$resultsRow = mysql_fetch_array($queryResult);
		
		return ++$resultsRow[0];
	}
	
	function calculate_last_ssn(){
		self::connectToDBEngineAndSelectDB();
		
		$selectQuery = "SELECT MAX(ssn) FROM student";
		$queryResult = mysql_query($selectQuery) or die(mysql_error());
		$resultsRow = mysql_fetch_array($queryResult);
		
		return $resultsRow[0];
	}
	
	static function calculate_total_students(){
		self::connectToDBEngineAndSelectDB();
		
		$selectQuery = "SELECT COUNT(ssn) FROM student";
		$queryResult = mysql_query($selectQuery) or die(mysql_error());
		$resultsRow = mysql_fetch_array($queryResult);
		
		return $resultsRow[0];
	}
}

?>