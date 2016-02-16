<?php
/*if(session_status()==PHP_SESSION_NONE){
	session_start();
}*/
if(strlen(session_id())<1){
    session_start();
}
if(!isset($_SESSION['user'])){
	header("Location: index.php");	
	exit();
}
?>
