<?php
header('Content-Type:application/json');
include "security/session_filter.php";
include 'db.php';
$firstName;
$lastName;
$email;
$password;
$login;
$company;
$type;
$userType;
$pageNum;
$num = 20;
$db =  new dbOperation();
$user = $_SESSION['user'];
$res = array('status' =>'ok');
$data = json_decode(file_get_contents('php://input'), true);
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
    $userType = $_POST['$userType'];
}
if(isset($_POST['pageNum'])){
    $pageNum = (int)$_POST['pageNum'];
}else{
    $pageNum = (int)$data['pageNum'];
}
if(isset($_POST['password'])){
    $password = $_POST['password'];
}

if(isset($type)){
	if($type=='saveUser'){

        $res = $db->userRegistered($username,$password);
        if($res->count == 1){
            echo json_encode($res);
        } else {
    		$db->saveUser($firstName,$lastName,$email,$login,$company,$password,$userType);
    		echo json_encode($res);
        } 
	}else if($type=='myProducts'){
		if(isset($pageNum)){
            $res['query'] = $db->getMyProducts($user['id'],($pageNum-1)*$num);
            $res['count'] = $db->getMyProductsCount($user['id']);
			echo json_encode($res);
		}
    }else if($type=='userList'){
        if(isset($pageNum)){
            $res['query'] = $db->getAllUser(($pageNum-1)*$num);
            $res['count'] = $db->getAllUserCount();
            echo json_encode($res);
        }
    }else if($type=="productsList"){
        if(isset($pageNum)){
            $res['query'] = $db->getAllProducts(($pageNum-1)*$num);
            $res['count'] = $db->getAllProductsCount();
            echo json_encode($res);
        }
    }else if($type=="login"){
        if(isset($email)&&isset($password)){
            echo json_encode($db->validateUser($email,$password));
        }
    }
}else{
    $res['data'] = $data;
 echo json_encode($res);
}
$db->closeConn();
