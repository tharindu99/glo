<?php
	define('SQL_HOST', "localhost");
	define('SQL_USER', "root");
	define('SQL_PASSWORD', "");
	define('SQL_DB',"studentimsdb");
	
	echo '<b>STUDENTIMS DATABASE - TABLE CREATION :</b><br />';
	$connectDb = mysql_connect(SQL_HOST, SQL_USER, SQL_PASSWORD) or die(mysql_error());
	echo '* '.SQL_HOST.', '.SQL_USER.', connected...<br />';
	$createDb = "CREATE DATABASE IF NOT EXISTS ".SQL_DB;
	mysql_query($createDb) or die(mysql_error());
	echo '* '.SQL_DB.', created... <br />';
	mysql_select_db(SQL_DB, $connectDb);
	echo '* '.SQL_DB.', Selected...<br />';
		
	/* 	Database table definitions... */
	$table1 = 	"CREATE TABLE IF NOT EXISTS administrator(
					username VARCHAR(20) NOT NULL,
					password VARCHAR(20) NOT NULL,
					isactive INT(1) NOT NULL,
								
					PRIMARY KEY (username)
				)";
			
	$table2 = 	"CREATE TABLE IF NOT EXISTS student(
					ssn INT(2) NOT NULL,
					name VARCHAR(50) NOT NULL,
					age INT(2) NOT NULL,
					year INT(1) NOT NULL,
					insertedby VARCHAR(20) NOT NULL,
								
					PRIMARY KEY (ssn),
					FOREIGN KEY (insertedby) REFERENCES administrator(username) ON UPDATE CASCADE ON DELETE RESTRICT
				)";
	
	echo "* Creating ".SQL_DB." Database Tables... <br/ >";
	mysql_query($table1) or die(mysql_error());
	echo "* Table 1, done.... <br/ >";
	mysql_query($table2) or die(mysql_error());
	echo "* Table 2, done.... <br/ >";
	echo "* Done, all ".SQL_DB." tables are now created...<br/ >";
?>