<?php
session_start();
require('controllers/login_handler.php');

//should progress only if loginHandler is not initiated...
if(login_handler::loginHandlerIsInitiated()){
	//do nothing...
}else{
	$login_handler = new login_handler();
	$login_handler->setCurrentUser('guest'); 
	$_SESSION['login_handler.currentUser'] = 'guest';
}
header("location:main/main_handler.main.php");
?>