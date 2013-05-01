<?php
class main_handler{
	static function generateMainPanel($login_handler){
		$currentUser = $login_handler->getCurrentUser();
		main_panel::loadHeader('StudentIMS - Main Panel');
		if($currentUser == 'guest'){
			main_panel::loadLinkLogin();
			main_panel::loadLinkViewStudentData();
		}else{
			main_panel::loadLinkLogout($currentUser);
			main_panel::loadLinkManipulateStudentData();
		}
		main_panel::loadFooter();
	}
}
?>