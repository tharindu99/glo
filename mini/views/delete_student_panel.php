<?php
class delete_student_panel extends panel{
	static function loadLinkBackToStudentPanel(){
		echo "<p>";
		echo "<a href='student_handler.main.php?action=view&pageRequest=1&pageRequestSource=0'><< Back to Student-Panel</a>";
		echo "</p>";
	}
	
	static function loadDeleteStudentForm($studentData){
		echo "<form action='student_handler.main.php?ssn=".$studentData['ssn']."' method='post'>";
		echo "<table>";
		echo "<tr><td>[1] Student SSN:&nbsp;&nbsp;&nbsp;</td><td><input type='text' name='ssn' disabled='disabled' value='".$studentData['ssn']."' /></td></tr>";
		echo "<tr><td>[2] Student's Name:&nbsp;&nbsp;&nbsp;</td><td><input type='text' name='name' disabled='disabled' value='".$studentData['name']."' /></td></tr>";
		echo "<tr><td>[3] Student's Age:&nbsp;&nbsp;&nbsp;</td><td><input type='text' name='age' disabled='disabled' value='".$studentData['age']."' /></td></tr>";
		echo "<tr><td>[4] Student's Year:&nbsp;&nbsp;&nbsp;</td><td><input type='text' name='year' disabled='disabled' value='".$studentData['year']."' /></td></tr>";
		echo "<tr><td>[5] Inserted By:&nbsp;&nbsp;&nbsp;</td><td><input type='text' name='year' disabled='disabled' value='".$studentData['insertedby']."' /></td></tr>";
		echo "</table>";
		echo "<br />";
		echo "<input type='submit' name='deleteButton' value='&nbsp;&nbsp;Delete&nbsp;&nbsp;' />";
		echo "</form>";
	}
}
?>