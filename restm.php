<?php
header('Content-Type:application/json');
header('Access-Control-Allow-Origin:*');
date_default_timezone_set("PRC");
//header('Access-Control-Allow-Headers:*');
include 'db.php';
include 'logger.php';

$firstName;
$lastName;
$email;
$password;
$login;
$company;
$type;
$userType;
$pageNum;
$db =  new dbOperation();
$logger = new logger();
$data = json_decode(file_get_contents('php://input'),true);
$res = array('status' =>'ok','data'=>file_get_contents('php://input'),'formatdata'=>$data,'post'=>$_POST);
if(isset($_POST['type'])){
    $type = $_POST['type'];
}else{
    $type = $data['type'];
}
if(isset($_POST['firstName'])){
	$firstName = $_POST['firstName'];
}
if(isset($_POST['lastName'])){
    $lastName = $_POST['lastName'];
}
if(isset($_POST['email'])){
    $email = $_POST['email'];
}
if(isset($_POST['login'])){
    $login = $_POST['login'];
}
if(isset($_POST['company'])){
    $company = $_POST['company'];
}
if(isset($_POST['userType'])){
    $userType = $_POST['userType'];
}
if(isset($_POST['pageNum'])){
    $pageNum = (int)$_POST['pageNum'];
}
if(isset($_POST['password'])){
    $password = $_POST['password'];
}

if(isset($type)){
	if($type=='saveUser'){
        // validate if username or email registered or not.
        $res = $db->userRegistered($login,$email);
        if($res[0]->count != 0){
            echo json_encode($res);
        } else {
    		$flag =  $db->saveUser($firstName,$lastName,$email,$company,$password,$login,$userType); // true or false
            if(!$flag){
                $res[0]->count = 1; // save failed
            }
    		echo json_encode($res); 
        }
        $logger->info($type." -- result: " . $res[0]->count);
	}else if($type=="login"){
        if(isset($login)&&isset($password)){
            echo json_encode($db->validateUser($login,$password));
        }
    }else if($type=="update"){
        if(isset($data)){
            echo json_encode($db->getMyProductsNoPaganition($data['userId']));
        }
    }else if($type=="backup"){
       if(isset($data)){
           $db->updateMyProducts($data['products'],$data['userId']); 
           echo json_encode($res);
       } 
    }else if($type=="findAccount"){
        if(isset($email)){
          $logger->info("request type: " .$type." -- email : " . $email);
          echo json_encode($db->findAccount($email,$email));
        }
    }else if($type=="validateSecCode"){
        //$logger->info($_POST['secCode']." -- ------: " . $_SESSION['secCode']);
        if(isset($_SESSION['secCode']) && isset($_POST['secCode'])){
          if($_SESSION['secCode'] == $_POST['secCode']){
            echo json_encode(array('status'=>'success'));
          } else{
            echo json_encode(array('status'=>'failed'));
          }
        }else{
          echo json_encode(array('status'=>'failed'));
        }
  	}else if($type=="resetPassword"){
        if(isset($login) && isset($password)){
          $logger->info("request type: " .$type." / login : " .$login. "/ password : ".$password); 
          $result = $db->resetPassword($login,$password);
          echo json_encode($res); 
        }
    }
}else{
 echo json_encode($res);
}
$db->closeConn();
