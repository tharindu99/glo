<?php
class view_student_panel extends panel{
	static function loadLinkBackToMainPanel(){
		echo "<p>";
		echo "<a href='main_handler.main.php'><< Back to Main-Panel</a>";
		echo "</p>";
	}
	
	static function loadLinkInsertNew(){
		echo "<p>";
		echo "<a href='student_handler.main.php?action=insert'>Insert New >></a>";
		echo "</p>";
	}
	
	static function loadStudentDataTableHeader($currentUser){
		echo "<p>";
		echo "<table border='1'>";
		echo "<tr>";
		echo "<td><b>&nbsp;SSN&nbsp;</b></td><td><b>&nbsp;NAME&nbsp;</b></td><td><b>&nbsp;AGE&nbsp;</b></td><td><b>&nbsp;YEAR&nbsp;</b></td>";
		if($currentUser != 'guest'){
			echo "<td><b>&nbsp;Inserted By&nbsp;</b></td><td><b>&nbsp;Action 1&nbsp;</b></td><td><b>&nbsp;Action 2&nbsp;</b></td>";
		}
		echo "</tr>";
	}

	static function loadStudentDataTableRow($currentUser, $studentData){
		echo "<tr>";
		echo "<td>&nbsp;".$studentData['ssn']."&nbsp;</td><td>&nbsp;".$studentData['name']."&nbsp;</td>";
		echo "<td>&nbsp;".$studentData['age']."&nbsp;</td><td>&nbsp;".$studentData['year']."&nbsp;</td>";
		if($currentUser != 'guest'){
			echo "<td>&nbsp;".$studentData['insertedby']."&nbsp;</td>";
			echo "<td>&nbsp;<a href='student_handler.main.php?action=update&ssn=".$studentData['ssn']."'>Update</a>&nbsp;</td>";
			echo "<td>&nbsp;<a href='student_handler.main.php?action=delete&ssn=".$studentData['ssn']."'>Delete</a>&nbsp;</td>";
		}
		echo "</tr>";
	}
	
	static function loadStudentDataTableFooter(){
		echo "</table>";
		echo "</p>";
	}
	
	static function loadPagingLinks($currentPage, $totalPagesToView){
		echo "<p>";
		echo "Showing Page";
		for($i = 1; $i <= $totalPagesToView; $i++){
			if($i == $currentPage){
				echo "&nbsp;[".$i."]";
			}else{
				echo "&nbsp;<a href='student_handler.main.php?action=view&pageRequest=".$i."&pageRequestSource=".$currentPage."'>".$i."</a>";
			}
		}
		echo "</p>";
	}
}

?>