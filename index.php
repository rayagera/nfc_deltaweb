<?php
include "db.php";
$db = new dbOperation();
$loginError = false;
if(strlen(session_id())<1){
	session_start();
}
if(isset($_SESSION['user'])){
	include "home.php";
}else{
	$username = null;
	$password = null;
	if(isset($_POST['name'])){
	    $username = $_POST['name'];
	}
	if(isset($_POST['pw'])){
	   $password = $_POST['pw'];
	}
	if($username!=null&&$password!=null){
		$res = $db->validateUser($username,$password);
		if(count($res)!=0){
			$_SESSION['user'] = $res[0];
			include "home.php";
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
