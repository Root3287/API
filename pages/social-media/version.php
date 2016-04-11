<?php
$CURRENT = "1.1.2.3";
$return = [
	'code'=>0, 
	'message' => "",
];
if(Input::exists('get')){
	if(Input::get('version') != "" && Input::get('uid') != "" && strlen(escape(Input::get('uid')))){
		if(version_compare($CURRENT, escape(Input::get('version'))) == 1){ //There is an update.
			$return['code'] = 0;
			$return['update'] = true;
			$return['message'] = "There is an update advailable";
			$return['old_version'] = escape(Input::get('version'));
			$return['new_version'] = $CURRENT;
			$return['uid'] = escape(Input::get('uid'));
			echo json_encode($return);
		}else if(version_compare($CURRENT, escape(Input::get('version'))) == 0){ // Up to date.
			$return['code'] = 0;
			$return['uid'] = escape(Input::get('uid'));
			$return['update'] = false;
			$return["message"] = "There is not an update yet";
			echo json_encode($return);
		}else{
			$return['code'] = 3; // Higher version
			$return['message'] = "You have a newer version than the server. This may have some issues."
			$return['update'] = false;
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
