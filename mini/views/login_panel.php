<?php
class login_panel extends panel{
	static function loadLinkBackToMainPanel(){
		echo "<p>";
		echo "<a href='main_handler.main.php'><< Back to Main-Panel</a>";
		echo "</p>";
	}
	
	static function loadLoginForm(){
		echo "<form action='login_handler.main.php' method='post'>";
		echo "<table>";
		echo "<tr><td>Enter Username:&nbsp;&nbsp;&nbsp;</td><td><input type='text' name='usernameField' /></td></tr>";
		echo "<tr><td>Enter Password:&nbsp;&nbsp;&nbsp;</td><td><input type='password' name='passwordField' /></td></tr>";
		echo "</table>";
		echo "<br />";
		echo "<input type='submit' name='loginButton' value='&nbsp;&nbsp;Sign-in&nbsp;&nbsp;' />";
		echo "</form>";
	}
}
?>