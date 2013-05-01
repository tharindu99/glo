<?php
class main_panel extends panel{
	static function loadLinkLogin(){
		echo "<p>";
		echo "Sign-in as Administrator <a href='login_handler.main.php?action=login'>here</a>";
		echo "</p>";
	}
	
	static function loadLinkLogout($currentUser){
		echo "<p>";
		echo "Hi! ".$currentUser." (Admin) | "."<a href='login_handler.main.php?action=logout'>Sign-out</a>";
		echo "</p>";
	}
	
	static function loadLinkViewStudentData(){
		echo "<p>";
		echo "<a href='student_handler.main.php?action=view&pageRequest=1&pageRequestSource=0'>View Student Data >></a>";
		echo "</p>";
	}
	
	static function loadLinkManipulateStudentData(){
		echo "<p>";
		echo "<a href='student_handler.main.php?action=view&pageRequest=1&pageRequestSource=0'>View <i>(Manipulate)</i> Student Data >></a>";
		echo "</p>";
	}
}

?>