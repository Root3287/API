<?php
$CURRENT = "0.0.1";
$DL_URL = "https://github.com/Root3287/Social-Media/archive/master.zip";
$return = [
	'code'=>0, 
	'message' => "",
];
if(Input::exists('get')){
	if(Input::get('version') != "" && Input::get('uid') != "" && strlen(Input::get('uid')) == 62){
		if(version_compare($CURRENT, escape(Input::get('version'))) == 1){ //There is an update.
			$return['code'] = 0;
			$return['update'] = true;
			$return['message'] = "There is an update advailable";
			$return['version'] = escape(Input::get('version'));
			$return['new_version'] = $CURRENT;
			$return['download_url'] = $DL_URL;
			$return['uid'] = escape(Input::get('uid'));
			echo json_encode($return);
		}else if(version_compare($CURRENT, escape(Input::get('version'))) == 0){
			$return['code'] = 0;
			$return['uid'] = escape(Input::get('uid'));
			$return['update'] = false;
			$return['version'] = escape(Input::get('version'));
			$return["message"] = "There is not an update yet";
			echo json_encode($return);
		}else{
			$return['update'] = false;
			$return['message'] = "You have a newer version than what the server has. This may have some issues.";
			$return['code'] = 3; //New Version
			echo json_encode($return);
		}
	}else{
		$return['code'] = "1"; //Wrong link
		$return['message'] = "The link is invalid";
		echo json_encode($return);
	}
}else{
	Redirect::to('/social-media/version/?uid=&version=');
}
