<?php
header('Content-Type:application/json');
header('Access-Control-Allow-Origin:*');
date_default_timezone_set("PRC");
//header('Access-Control-Allow-Headers:*');
include 'db.php';
include 'logger.php';
 
 
$email; 
$type; 
$db =  new dbOperation();
$logger = new logger();
$data = json_decode(file_get_contents('php://input'),true);
$res = array('status' =>'ok','data'=>file_get_contents('php://input'),'formatdata'=>$data,'post'=>$_POST);

$logger->info(" ----- get request -----");

if(isset($_POST['type'])){
    $type = $_POST['type'];
}else{
    $type = $data['type'];
}
if(isset($_POST['email'])){
    $email = $_POST['email'];
}else{
    $email = $data['email'];
}

$logger->info(" -- request type = " . $type . "  email=" .$email);

if(isset($type)){
  if($type=="findAccount"){
        if(isset($email)){
          $logger->info("request type: " .$type." -- email : " . $email);
          echo json_encode($db->findAccount($email,$email));
           
        }
    }
} else {
  echo json_encode($res);
}

$db->closeConn();
/**/