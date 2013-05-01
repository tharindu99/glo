<?php
class insert_student_panel extends panel{
	static function loadLinkBackToStudentPanel(){
		echo "<p>";
		echo "<a href='student_handler.main.php?action=view&pageRequest=1&pageRequestSource=0'><< Back to Student-Panel</a>";
		echo "</p>";
	}
	
	static function loadInsertStudentForm($nextSsn, $currentUser){
		echo "<form action='student_handler.main.php?ssn=".$nextSsn."' method='post'>";
		echo "<table>";
		echo "<tr><td>[1] Next Student SSN:&nbsp;&nbsp;&nbsp;</td><td><input type='text' name='ssn' disabled='disabled' value='".$nextSsn."'/></td></tr>";
		echo "<tr><td>[2] Enter Student's Name:&nbsp;&nbsp;&nbsp;</td><td><input type='text' name='name' /></td></tr>";
		echo "<tr><td>[3] Enter Student's Age:&nbsp;&nbsp;&nbsp;</td><td><input type='text' name='age' /></td></tr>";
		echo "<tr><td>[4] Enter Student's Year:&nbsp;&nbsp;&nbsp;</td><td><input type='text' name='year' /></td></tr>";
		echo "<tr><td>[5] Inserted By:&nbsp;&nbsp;&nbsp;</td><td><input type='text' name='year' disabled='disabled' value='".$currentUser."'/></td></tr>";
		echo "</table>";
		echo "<br />";
		echo "<input type='reset' value='&nbsp;Clear&nbsp;'>";
		echo "&nbsp;";
		echo "<input type='submit' name='insertButton' value='&nbsp;&nbsp;Insert&nbsp;&nbsp;' />";
		echo "</form>";
	}
}
?>