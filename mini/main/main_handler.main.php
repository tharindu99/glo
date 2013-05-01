<?php
session_start();
require('../views/panel.php');
require('../views/main_panel.php');
require('../controllers/login_handler.php');
require('../controllers/main_handler.php');

//should progress only if loginHandler is initiated...
if(login_handler::loginHandlerIsInitiated()){
	$login_handler = new login_handler();
	$login_handler->setCurrentUser($_SESSION['login_handler.currentUser']);
	main_handler::generateMainPanel($login_handler);
}else{
	header("location:../index.php");
}
?>