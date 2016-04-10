<?php
$CURRENT = "1.1.2.3";
$return = [
	'code'=>0, 
	'message' => "",
];
if(Input::exists('get')){
	if(Input::get('version') != "" && Input::get('uid') != ""){
		if(version_compare($CURRENT, escape(Input::get('version'), '<'))){ //There is an update.
			$return['update'] = true;
			$return['message'] = "There is an update advailable";
			$return['old_version'] = escape(Input::get('version'));
			$return['new_version'] = $CURRENT;
			echo json_encode($return);
		}else{
			$return['update'] = false;
			$return["message"] = "There is not an update yet";
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