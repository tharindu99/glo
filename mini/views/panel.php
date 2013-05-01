<?php
class panel{
	static function loadHeader($panelTitle){
		echo "<html>";
		echo "<head>";
		echo "<title>".$panelTitle."</title>";
		echo "<link rel='shortcut icon' type='image/x-icon' href='../favicon.ico' />";
		echo "<link rel='stylesheet' type='text/css' href='../views/css/style.css' />";
		echo "</head>";
		echo "<body>";
		echo "<fieldset>";
		echo "<legend>&nbsp;".$panelTitle.":&nbsp;</legend>";
	}
	
	static function loadFooter(){
		echo "</fieldset>";
		echo "<p align='center'><font size='1'>Copyright &copy; ".date("Y")." Created by Tharindu Madushanka Peris for practice to mini project| All rights reserved.</font></p>";
		echo "</body>";
		echo "</html>";
	}
	
	static function loadMessage($message){
		echo "<fieldset>";
		echo "<font color='green'>INFO: ".$message."</font>";
		echo "</fieldset>";
		echo "<br />";
	}
	
	static function loadAlert($alert){
		echo "<fieldset>";
		echo "<font color='orange'>ALERT: ".$alert."</font>";
		echo "</fieldset>";
		echo "<br />";
	}
	
	static function loadError($errorMessage){
		echo "<fieldset>";
		echo "<font color='red'>ERROR: ".$errorMessage."</font>";
		echo "</fieldset>";
		echo "<br />";
	}
}
?>