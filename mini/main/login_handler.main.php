<?php
session_start();
require('../views/panel.php');
require('../views/login_panel.php');
require('../controllers/login_handler.php');
require('../models/administrator.php');

//should progress only if loginHandler is initiated...
if(login_handler::loginHandlerIsInitiated()){
	if(login_handler::actionIsTriggered()){
		$action = login_handler::getActionTriggered();
		if($action == 'login'){
			$login_handler = new login_handler();
			$login_handler->setCurrentUser($_SESSION['login_handler.currentUser']);
			if($login_handler->getCurrentUser() == 'guest'){
				login_handler::serveLoginFormRequest($login_handler);
			}else{
				header("location:main_handler.main.php");
			}
		}else if($action == 'logout'){
			$login_handler = new login_handler();
			$login_handler->setCurrentUser($_SESSION['login_handler.currentUser']);
			$login_handler->serveLogoutRequest();
		}else{
			header("location:main_handler.main.php");
		}	
	}else if(login_handler::loginButtonIsPressed()){
		$usernameFieldInput = login_handler::getUsernameSubmitted();
		$passwordFieldInput = login_handler::getPasswordSubmitted();
		$administrator = new administrator();
		$login_handler = new login_handler();
		$login_handler->setCurrentUser($_SESSION['login_handler.currentUser']);
		$login_handler->serveLoginRequest($usernameFieldInput, $passwordFieldInput, $administrator);
	}else{
		header("location:main_handler.main.php");
	}
}else{
	header("location:../index.php");
}
?>