<?php
class login_handler{
	private $currentUser;
	
	function __construct(){}
	
	static function loginHandlerIsInitiated(){
		return isset($_SESSION['login_handler.currentUser']);
	}
	
	function setCurrentUser($currentUser){
		$this->currentUser = $currentUser;
	}
	
	function getCurrentUser(){
		return $this->currentUser;
	}
	
	static function actionIsTriggered(){
		return isset($_REQUEST['action']);
	}
	
	static function getActionTriggered(){
		return $_REQUEST['action'];
	}
	
	static function loginButtonIsPressed(){
		return isset($_POST['loginButton']);
	}
	
	//get login data submitted via forms...
	static function getUsernameSubmitted(){
		return $_POST['usernameField'];
	}
	
	static function getPasswordSubmitted(){
		return $_POST['passwordField'];
	}
	
	static function serveLoginFormRequest(){
		login_panel::loadHeader('StudentIMS - Login Panel');
		login_panel::loadLinkBackToMainPanel();
		login_panel::loadLoginForm();
		login_panel::loadFooter();
	}
	
	function serveLoginRequest($usernameFieldInput, $passwordFieldInput, $administrator){
		if($usernameFieldInput == '' || $passwordFieldInput == ''){
			login_panel::loadError('Username or password or both is/are empty...');
			login_handler::serveLoginFormRequest();
		}else{
			$isAvailable = $administrator->select($usernameFieldInput);
			if($isAvailable){
				if($passwordFieldInput == $administrator->getPassword()){
					if($administrator->getIsActive() == 1){
						$this->setCurrentUser($usernameFieldInput);
						$_SESSION['login_handler.currentUser'] = $usernameFieldInput;
						header("location:../main/main_handler.main.php");
					}else{
						login_panel::loadError('Your login is currently inactive...');
						login_handler::serveLoginFormRequest();
					}
				}else{
					login_panel::loadError('Forgot your password!, try again...');
					login_handler::serveLoginFormRequest();
				}
			}else{
				login_panel::loadError('Incorrect Username and Passowrd!, try again...');
				login_handler::serveLoginFormRequest();
			}
		}
	}
	
	function serveLogoutRequest(){
		$this->setCurrentUser('guest');
		$_SESSION['login_handler.currentUser'] = 'guest';
		header("location:../main/main_handler.main.php");
	}
}
?>