<?php
class update_student_panel extends panel{
	static function loadLinkBackToStudentPanel(){
		echo "<p>";
		echo "<a href='student_handler.main.php?action=view&pageRequest=1&pageRequestSource=0'><< Back to Student-Panel</a>";
		echo "</p>";
	}
	
	static function loadUpdateStudentForm($studentData){
		echo "<form action='student_handler.main.php?ssn=".$studentData['ssn']."' method='post'>";
		echo "<table>";
		echo "<tr><td>[1] Student SSN:&nbsp;&nbsp;&nbsp;</td><td><input type='text' name='ssn' disabled='disabled' value='".$studentData['ssn']."' /></td></tr>";
		echo "<tr><td>[2] Student's Name:&nbsp;&nbsp;&nbsp;</td><td><input type='text' name='name' value='".$studentData['name']."' /></td></tr>";
		echo "<tr><td>[3] Student's Age:&nbsp;&nbsp;&nbsp;</td><td><input type='text' name='age' value='".$studentData['age']."' /></td></tr>";
		echo "<tr><td>[4] Student's Year:&nbsp;&nbsp;&nbsp;</td><td><input type='text' name='year' value='".$studentData['year']."' /></td></tr>";
		echo "<tr><td>[5] Inserted By:&nbsp;&nbsp;&nbsp;</td><td><input type='text' name='ssn' disabled='disabled' value='".$studentData['insertedby']."' /></td></tr>";
		echo "</table>";
		echo "<br />";
		echo "<input type='reset' value='&nbsp;Reset&nbsp;'>";
		echo "&nbsp;";
		echo "<input type='submit' name='updateButton' value='&nbsp;&nbsp;Update&nbsp;&nbsp;' />";
		echo "</form>";
	}
}
?>