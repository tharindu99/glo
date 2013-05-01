<?php
session_start();
require('../views/panel.php');
require('../views/view_student_panel.php');
require('../views/insert_student_panel.php');
require('../views/update_student_panel.php');
require('../views/delete_student_panel.php');
require('../controllers/login_handler.php');
require('../controllers/student_handler.php');
require('../models/student.php');

//should progress only if loginHandler is initiated...
if(login_handler::loginHandlerIsInitiated()){
	if(student_handler::actionIsTriggered()){
		if(student_handler::getActionTriggered() == 'view' && student_handler::pageRequestIsSet() && student_handler::pageRequestSourceIsSet()){
			$login_handler = new login_handler();
			$login_handler->setCurrentUser($_SESSION['login_handler.currentUser']);
			$pageRequest = student_handler::getPageRequest();
			$pageRequestSource = student_handler::getPageRequestSource();
			$rowsPerPage = 3;
			student_handler::serveViewStudentDataRequest($login_handler, $pageRequest, $pageRequestSource, $rowsPerPage);
		}else if(student_handler::getActionTriggered() == 'insert'){
			$login_handler = new login_handler();
			$login_handler->setCurrentUser($_SESSION['login_handler.currentUser']);
			if($login_handler->getCurrentUser() != 'guest'){
				student_handler::serveInsertFormRequest($login_handler);
			}else{
				header("location:main_handler.main.php");
			}
		}else if(student_handler::getActionTriggered() == 'update' && student_handler::ssnIsSetToActUpon()){
			$login_handler = new login_handler();
			$login_handler->setCurrentUser($_SESSION['login_handler.currentUser']);
			if($login_handler->getCurrentUser() != 'guest'){
				$ssn = student_handler::getSsnToActUpon();
				student_handler::serveUpdateFormRequest($ssn);
			}else{
				header("location:main_handler.main.php");
			}
		}else if(student_handler::getActionTriggered() == 'delete' && student_handler::ssnIsSetToActUpon()){
			$login_handler = new login_handler();
			$login_handler->setCurrentUser($_SESSION['login_handler.currentUser']);
			if($login_handler->getCurrentUser() != 'guest'){
				$ssn = student_handler::getSsnToActUpon();
				student_handler::serveDeleteFormRequest($ssn);
			}else{
				header("location:main_handler.main.php");
			}
		}else{
			header("location:main_handler.main.php");
		}
	}else if(student_handler::insertButtonIsPressed()){
		$login_handler = new login_handler();
		$login_handler->setCurrentUser($_SESSION['login_handler.currentUser']);
		$studentData = student_handler::getStudentDataSubmitted();
		student_handler::serveInsertStudentDataRequest($login_handler, $studentData);
	}else if(student_handler::updateButtonIsPressed()){
		$studentData = student_handler::getStudentDataSubmitted();
		student_handler::serveUpdateStudentDataRequest($studentData);
	}else if(student_handler::deleteButtonIsPressed()){
		$ssn = student_handler::getSsnSubmitted();
		student_handler::serveDeleteStudentDataRequest($ssn);
	}else{
		header("location:main_handler.main.php");
	}
}else{
	header("location:../index.php");
}
?>