<?php
include "db.php";
$db = new dbOperation();
$loginError = false;
$url = "home.php";

if(strlen(session_id())<1){
	session_start();
}
if(isset($_SESSION['user'])){
	echo "<script>window.location =\"$url\";</script>";
}else{
	$userId = null;
	if(isset($_GET['userId'])){
	    $userId = $_GET['userId'];
	}

	if($userId!=null){
		$res = $db->getUserById($userId);
		if(count($res)!=0){
			$_SESSION['user'] = $res[0];
			echo "<script>window.location =\"$url\";</script>";
		}else{
			$loginError = true;
			include "login.php";
		}
	}else{
		include "login.php";
	}
}
$db->closeConn();
?>
