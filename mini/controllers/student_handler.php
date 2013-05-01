<?php
class student_handler{
	//to identify action triggers...
	static function actionIsTriggered(){
		return isset($_REQUEST['action']);
	}
	
	static function getActionTriggered(){
		return $_REQUEST['action'];
	}
	
	//get ssn to act(update, delete) upon...
	static function ssnIsSetToActUpon(){
		return isset($_REQUEST['ssn']);
	}
	
	static function getSsnToActUpon(){
		return (int)$_REQUEST['ssn'];
	}
	
	//if action == 'view'...
	static function pageRequestIsSet(){
		return isset($_REQUEST['pageRequest']);
	}
	
	static function getPageRequest(){
		return (int)$_REQUEST['pageRequest'];
	}
	
	static function pageRequestSourceIsSet(){
		return isset($_REQUEST['pageRequestSource']);
	}
	
	static function getPageRequestSource(){
		return (int)$_REQUEST['pageRequestSource'];
	}
	
	//to identify button triggers...
	static function insertButtonIsPressed(){
		return isset($_POST['insertButton']);
	}
	
	static function updateButtonIsPressed(){
		return isset($_POST['updateButton']);
	}
	
	static function deleteButtonIsPressed(){
		return isset($_POST['deleteButton']);
	}
	
	//get student data submitted via forms...
	
	static function getSsnSubmitted(){
		return (int)$_REQUEST['ssn'];
	}
	
	static function getNameSubmitted(){
		return $_POST['name'];
	}
	
	static function getAgeSubmitted(){
		return (int)$_POST['age'];
	}
	
	static function getYearSubmitted(){
		return (int)$_POST['year'];
	}
	
	static function getStudentDataSubmitted(){
		$studentData = array(
			'ssn' => self::getSsnSubmitted(),
			'name' => self::getNameSubmitted(),
			'age' => self::getAgeSubmitted(),
			'year' => self::getYearSubmitted()
		);
		
		return $studentData;
	}
	
	static function serveViewStudentDataRequest($login_handler, $pageRequest, $pageRequestSource, $rowsPerPage){
		//calculate total students...
		$totalStudents = student::calculate_total_students();
		if($totalStudents == 0){
			view_student_panel::loadAlert('No student data is found currently, Produced an empty result set...');
			view_student_panel::loadHeader('StudentIMS - View Student Panel');
			view_student_panel::loadLinkBackToMainPanel();
			//check login status and enable 'Insert new student' link...
			$currentUser = $login_handler->getCurrentUser();
			if($currentUser != 'guest'){
				view_student_panel::loadLinkInsertNew();
			}
			view_student_panel::loadFooter();
		}else{
			view_student_panel::loadHeader('StudentIMS - View Student Panel');
			view_student_panel::loadLinkBackToMainPanel();
			//check login status and enable 'Insert new student' link...
			$currentUser = $login_handler->getCurrentUser();
			if($currentUser != 'guest'){
				view_student_panel::loadLinkInsertNew();
			}
			//check login status and print student data tabel header...
			view_student_panel::loadStudentDataTableHeader($currentUser);
			//generating table rows according to page request...
			$lastSsn = student::calculate_last_ssn();
			$nextSsnToStart;
			if($pageRequest == 1 && $pageRequestSource == 0){
				$_SESSION['lastViewedSsn'] = 0;
				$nextSsnToStart = 1;
			}else{
				if($pageRequest>$pageRequestSource){
					//forward traversal...
					$ssnToStartTraversal = $_SESSION['lastViewedSsn']+1;
					$ssnsToPass = ($pageRequest-$pageRequestSource-1)*$rowsPerPage;
					if($ssnsToPass > 0){
						$ssnsPassed = 0;
						for($i = $ssnToStartTraversal; $i <= $lastSsn; $i++){
							$student = new student();
							$retVal = $student->select($i);
							if($retVal != 0){
								$ssnsPassed++;
								if($ssnsPassed == $ssnsToPass){
									$nextSsnToStart = $i+1;
									break;
								}
							}else{
								//do nothing...
							}
						}
					}else{
						$nextSsnToStart = $_SESSION['lastViewedSsn']+1;
					}
				}else{
					//backward traversal...
					$ssnToStartTraversal = $_SESSION['firstViewedSsn']-1;
					$ssnsToPass = ($pageRequestSource-$pageRequest)*$rowsPerPage;
					$ssnsPassed = 0;
					for($i = $ssnToStartTraversal; $i > 0; $i--){
						$student = new student();
						$retVal = $student->select($i);
						if($retVal != 0){
							$ssnsPassed++;
							if($ssnsPassed == $ssnsToPass){
								$nextSsnToStart = $i;
								break;
							}
						}else{
							//do nothing...
						}
					}
				}
			}
			
			$rowsPrinted = 0;
			for($i = $nextSsnToStart; $i <= $lastSsn; $i++){
				$student = new student();
				$retVal = $student->select($i);
				if($retVal != 0){
					$studentData = array(
						'ssn' => $student->getSsn(), 
						'name' => $student->getName(), 
						'age' => $student->getAge(), 
						'year' => $student->getYear(),
						'insertedby' => $student->getInsertedBy()
					);
					//check login status and print a table row...
					view_student_panel::loadStudentDataTableRow($currentUser, $studentData);
					$rowsPrinted++;
					if($rowsPrinted == 1){
						$_SESSION['firstViewedSsn'] = $i;
					}
					if($rowsPrinted == $rowsPerPage){
						$_SESSION['lastViewedSsn'] = $i;
						break;
					}
				}else{
					//do nothing...
				}
			}
			view_student_panel::loadStudentDataTableFooter();
			//calculate total pages to view and enable paging links...
			if($totalStudents%$rowsPerPage == 0){
				$totalPagesToView = $totalStudents/$rowsPerPage;
			}else{
				$tempVal = (int)($totalStudents/$rowsPerPage);
				$totalPagesToView = $tempVal + 1;
			}
			view_student_panel::loadPagingLinks($pageRequest, $totalPagesToView);
			view_student_panel::loadFooter();
		}
	}
	
	static function serveInsertFormRequest($login_handler){
		$student = new student();
		$nextSsn = $student->calculate_next_ssn();
		insert_student_panel::loadHeader('StudentIMS - Insert New Student');
		insert_student_panel::loadLinkBackToStudentPanel();
		$currentUser = $login_handler->getCurrentUser(); 
		insert_student_panel::loadInsertStudentForm($nextSsn, $currentUser);
		insert_student_panel::loadFooter();
	}
	
	static function serveUpdateFormRequest($ssn){
		$student = new student();
		$student->select($ssn);
		$studentData = array(
			'ssn' => $student->getSsn(), 
			'name' => $student->getName(), 
			'age' => $student->getAge(), 
			'year' => $student->getYear(),
			'insertedby' => $student->getInsertedBy()
		);
		update_student_panel::loadHeader('StudentIMS - Update Student');
		update_student_panel::loadLinkBackToStudentPanel();
		update_student_panel::loadUpdateStudentForm($studentData);
		update_student_panel::loadFooter();
	}
	
	static function serveDeleteFormRequest($ssn){
		$student = new student();
		$student->select($ssn);
		$studentData = array(
			'ssn' => $student->getSsn(), 
			'name' => $student->getName(), 
			'age' => $student->getAge(), 
			'year' => $student->getYear(),
			'insertedby' => $student->getInsertedBy()
		);
		delete_student_panel::loadAlert('You are about to delete a student entry, this action cannot be recovered later...');
		delete_student_panel::loadHeader('StudentIMS - Delete Student');
		delete_student_panel::loadLinkBackToStudentPanel();
		delete_student_panel::loadDeleteStudentForm($studentData);
		delete_student_panel::loadFooter();
	}
	
	static function serveInsertStudentDataRequest($login_handler, $studentData){
		if($studentData['name'] == '' || $studentData['age'] == '' || $studentData['year'] == ''){
			insert_student_panel::loadError('Atleast one data field was incorrect or empty...');
			self::serveInsertFormRequest($login_handler);
		}else{
			$student = new student();
			$student->setSsn($studentData['ssn']);
			$student->setName($studentData['name']);
			$student->setAge($studentData['age']);
			$student->setYear($studentData['year']);
			$student->setInsertedBy($login_handler->getCurrentUser());
			$student->insert();
			
			insert_student_panel::loadMessage('Student Data Insertion - Successful...');
			self::serveInsertFormRequest($login_handler);
		}
	}
	
	static function serveUpdateStudentDataRequest($studentData){
		if($studentData['name'] == '' || $studentData['age'] == '' || $studentData['year'] == ''){
			update_student_panel::loadError('Atleast one data field was incorrect or empty, Please try again...');
			self::serveUpdateFormRequest($studentData['ssn']);
		}else{
			$student = new student();
			$student->setSsn($studentData['ssn']);
			$student->setName($studentData['name']);
			$student->setAge($studentData['age']);
			$student->setYear($studentData['year']);
			$student->update();
			
			update_student_panel::loadMessage('Student Data Updating - Successful...');
			$login_handler = new login_handler();
			$login_handler->setCurrentUser($_SESSION['login_handler.currentUser']);
			self::serveViewStudentDataRequest($login_handler, 1, 0, 3);
		}
	}
	
	static function serveDeleteStudentDataRequest($ssn){
		$student = new student();
		$student->setSsn($ssn);
		$student->delete();
		
		delete_student_panel::loadMessage('Student Data Deleting - Successful...');
		$login_handler = new login_handler();
		$login_handler->setCurrentUser($_SESSION['login_handler.currentUser']);
		self::serveViewStudentDataRequest($login_handler, 1, 0, 3);
	}
}
?>