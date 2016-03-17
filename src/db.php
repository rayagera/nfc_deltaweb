<?php
class dbOperation{

	/*const HOST = 'localhost';
	const NAME = 'nfcdelta';
	const PASSWORD = 'nfcdelta2015';
	const DBNAME = 'deltaplus';*/

	const HOST = 'localhost';
	const NAME = 'root';
	const PASSWORD = 'root';
	const DBNAME = 'deltaplus';

	
	private $conn = NULL;

	function __construct(){
		$this->conn = mysqli_connect(self::HOST, self::NAME, self::PASSWORD, self::DBNAME);
		if(mysqli_connect_errno()){
			echo 'MySQL connection error:'.mysqli_connect_error();
		}else{
			$this->createTable();
		}
	}

	function closeConn(){
		if(isset($this->conn)){
			mysqli_close($this->conn);
		}
	}

	function createTable(){
		if(isset($this->conn)){
			mysqli_query($this->conn, 'CREATE TABLE IF NOT EXISTS DELTAPLUS_USER(
										USER_ID INT(11) NOT NULL AUTO_INCREMENT,
										EMAIL VARCHAR(100) DEFAULT NULL,
										LOGIN VARCHAR(100) DEFAULT NULL,
										PASSWORD VARCHAR(100) DEFAULT NULL,
										FIRST_NAME VARCHAR(30) DEFAULT NULL,
										LAST_NAME VARCHAR(30) DEFAULT NULL,
										COMPANY VARCHAR(100) DEFAULT NULL,
										USER_TYPE INT(1) DEFAULT NULL,
										CREATE_DATE DATE DEFAULT NULL,
										LAST_UPDATE_DATE DATE DEFAULT NULL,
										PRIMARY KEY (USER_ID),
										UNIQUE INDEX EMAIL_UNIQUE (EMAIL ASC))
										ENGINE = InnoDB
										DEFAULT CHARSET = utf8;');
										
            mysqli_query($this->conn, 'CREATE TABLE IF NOT EXISTS DELTAPLUS_PRODUCT(
										ID INT(11) NOT NULL AUTO_INCREMENT,
										PRODUCT VARCHAR(10) DEFAULT NULL,
										SERIAL VARCHAR(12) DEFAULT NULL,
										USERNAME VARCHAR(15) DEFAULT NULL,
										PROD_DATE VARCHAR(10) DEFAULT NULL,
										START_DATE VARCHAR(10) DEFAULT NULL,
										SAV1 VARCHAR(10) DEFAULT NULL,
										SAV2 VARCHAR(10) DEFAULT NULL,
										SAV3 VARCHAR(10) DEFAULT NULL,
										SAV4 VARCHAR(10) DEFAULT NULL,
										SAV5 VARCHAR(10) DEFAULT NULL,
										IS_DELETED INT(1) DEFAULT NULL,
										CREATE_DATE DATE DEFAULT NULL,
										LAST_UPDATE_DATE DATE DEFAULT NULL,
										DELTA_USER_ID INT(11) NOT NULL,
										PRIMARY KEY (ID),
										INDEX FK_USER_IDX (DELTA_USER_ID ASC),
										CONSTRAINT FK_USER
											FOREIGN KEY (DELTA_USER_ID)
											REFERENCES DELTAPLUS_USER (USER_ID))
										ENGINE = InnoDB
										DEFAULT CHARSET = utf8');
		}
	}
	function getMyProducts($userId, $preNum){
		if(isset($userId)){
			$query = mysqli_query($this->conn,"SELECT * FROM DELTAPLUS_PRODUCT WHERE DELTA_USER_ID = '$userId' AND IS_DELETED = 0 LIMIT ".$preNum.',20');
			$array = array();
			while($row = mysqli_fetch_array($query)){
				$array1 = array('id'=>$row['ID'], 'production'=>$row['PRODUCT'], 'serial'=>$row['SERIAL'], 'user'=>$row['USERNAME'],
				'prod'=>$row['PROD_DATE'], 'start'=>$row['START_DATE'], 'sav1'=>$row['SAV1'], 'sav2'=>$row['SAV2'], 'sav3'=>$row['SAV3'],
				'sav4'=>$row['SAV4'], 'sav5'=>$row['SAV5'], 'i_date'=>$row['CREATE_DATE'], 'u_date'=>$row['LAST_UPDATE_DATE']);
				array_push($array, $array1);
			}
			return $array;
		}
	}
    function getMyProductsCount($userId){
        $query = mysqli_query($this->conn,"SELECT COUNT(*) totalCount FROM DELTAPLUS_PRODUCT WHERE DELTA_USER_ID = '$userId' AND IS_DELETED = 0");
        return mysqli_fetch_object($query);
    }
    function getAllProducts($preNum){
        $query = mysqli_query($this->conn,"SELECT P.ID, P.PRODUCT, P.SERIAL, P.USERNAME, P.PROD_DATE, P.START_DATE, P.SAV1,
		P.SAV2, P.SAV3, P.SAV4, P.SAV5, CONCAT(U.FIRST_NAME, ' ', U.LAST_NAME) USER_NAME FROM DELTAPLUS_PRODUCT P, DELTAPLUS_USER U 
		WHERE P.DELTA_USER_ID = U.USER_ID AND P.IS_DELETED = 0 LIMIT ".$preNum.',20');
        $array = array();
        while($row = mysqli_fetch_array($query)){
            $array1 = array('id'=>$row['ID'], 'production'=>$row['PRODUCT'], 'serial'=>$row['SERIAL'], 'user'=>$row['USERNAME'],
			'prod'=>$row['PROD_DATE'], 'start'=>$row['START_DATE'], 'sav1'=>$row['SAV1'], 'sav2'=>$row['SAV2'], 'sav3'=>$row['SAV3'],
			'sav4'=>$row['SAV4'],'sav5'=>$row['SAV5'],'user_name'=>$row['USER_NAME']);
            array_push($array, $array1);
        }
        return $array;
    }
    function getAllProductsCount(){
        $query = mysqli_query($this->conn,"SELECT COUNT(*) totalCount FROM DELTAPLUS_PRODUCT WHERE IS_DELETED = 0");
        return mysqli_fetch_object($query);
    }
	function getAllUser($preNum){
		$query = mysqli_query($this->conn,"SELECT * FROM DELTAPLUS_USER LIMIT ".$preNum.',20');
		$array = array();
		while($row = mysqli_fetch_array($query)){
			$array1 = array('id'=>$row['USER_ID'], 'email'=>$row['EMAIL'], 'firstName'=>$row['FIRST_NAME'], 'lastName'=>$row['LAST_NAME'],
			'company'=>$row['COMPANY'],'password'=>$row['PASSWORD'],'login'=>$row['LOGIN']);
			array_push($array, $array1);
		}
		return $array;
	}
    function getAllUserCount(){
        $query = mysqli_query($this->conn,"SELECT COUNT(*) totalCount FROM DELTAPLUS_USER");
        return mysqli_fetch_object($query);
    }
    function saveUser($firstname,$lastname,$email,$company,$password,$login,$type){
       return mysqli_query($this->conn,"INSERT INTO DELTAPLUS_USER(USER_ID, EMAIL, PASSWORD, FIRST_NAME, LAST_NAME, COMPANY, LOGIN, USER_TYPE) 
		VALUES(NULL, '$email', '$password', '$firstname', '$lastname', '$company', '$login', '$type')");
    }
    function getSingleUser($login, $password){
        $query = mysqli_query($this->conn,"SELECT * FROM DELTAPLUS_USER WHERE LOGIN = '$login' AND PASSWORD = '$password'");
        $array = array();
        while($row = mysqli_fetch_array($query)){
            $array1 = array('id'=>$row['USER_ID'], 'firstName'=>$row['FIRST_NAME'], 'lastName'=>$row['LAST_NAME'], 'company'=>$row['COMPANY'], 
			'password'=>$row['PASSWORD']);
            array_push($array, $array1);
        }
        return $array;
    }
    function validateUser($login, $password){
        $query = mysqli_query($this->conn,"SELECT USER_ID, CONCAT(FIRST_NAME, ' ', LAST_NAME) NAME, USER_TYPE FROM DELTAPLUS_USER 
		WHERE LOGIN = '$login' AND PASSWORD = '$password' ORDER BY USER_ID DESC");
        $array = array();
        while($row = mysqli_fetch_array($query)){
            $array1 = array('id'=>$row['USER_ID'],'name'=>$row['NAME'],'type'=>$row['USER_TYPE']);
            array_push($array, $array1);
        }
        return $array;
    }


    /**
     * validate user or emailed registered or not
     */
    function userRegistered($login, $email){
        $query = mysqli_query($this->conn,"select count(*) as count from DELTAPLUS_USER where EMAIL = '$email' or LOGIN = '$login'" );
        $array = array();
        $res = mysqli_fetch_object($query);
        array_push($array, $res);
        return $array;
    }


	/**
     * validate user or emailed registered or not
     */
    function findAccount($login, $email){
        $query = mysqli_query($this->conn,"select login, email from DELTAPLUS_USER where EMAIL = '$email' or LOGIN = '$login'" );
        $array = array();
        $res = mysqli_fetch_object($query);
        if($res){
        	array_push($array, $res);
        }
        /*while($row = mysqli_fetch_array($query)){
            $array1 = array('login'=>$row['login'],'email'=>$row['email']);
            array_push($array, $array1);
        }*/
        return $array;
    }
    /**
     * [validateUser description]
     * @param  [type] $login    [description]
     * @param  [type] $password [description]
     * @return [type]           [description]
     */
    function getUserById($userId){
        $query = mysqli_query($this->conn,"SELECT USER_ID, CONCAT(FIRST_NAME, ' ', LAST_NAME) NAME, USER_TYPE FROM DELTAPLUS_USER 
		WHERE USER_ID = '$userId' limit 1");
        $array = array();
        while($row = mysqli_fetch_array($query)){
            $array1 = array('id'=>$row['USER_ID'],'name'=>$row['NAME'],'type'=>$row['USER_TYPE']);
            array_push($array, $array1);
        }
        return $array;
    }

    /**
    *for mobile only
    */

    function getMyProductsNoPaganition($userId){
		if(isset($userId)){
			$query = mysqli_query($this->conn,"SELECT * FROM DELTAPLUS_PRODUCT WHERE DELTA_USER_ID = '$userId'");
			$array = array();
			while($row = mysqli_fetch_array($query)){
				$array1 = array('id'=>$row['ID'], 'product'=>$row['PRODUCT'], 'serial'=>$row['SERIAL'], 'user'=>$row['USERNAME'], 
				'prod'=>$row['PROD_DATE'], 'start'=>$row['START_DATE'], 'sav1'=>$row['SAV1'], 'sav2'=>$row['SAV2'], 'sav3'=>$row['SAV3'], 
				'sav4'=>$row['SAV4'], 'sav5'=>$row['SAV5'], 'ifDelete'=>$row['IS_DELETED']);
				array_push($array, $array1);
			}
			return $array;
		}
    }

    function updateMyProducts($data, $userId){
    	if(isset($data)&&isset($userId)){
			foreach ($data as $item) {
                $production = $item['product'];
				$serial = $item['serial'];
				$user = $item['user'];
				$prod = $item['prod'];
				$start = $item['start'];
				$sav1 = $item['sav1'];
				$sav2 = $item['sav2'];
				$sav3 = $item['sav3'];
				$sav4 = $item['sav4'];
				$sav5 = $item['sav5'];
                $ifDelete = $item['ifDelete'];
                $query = mysqli_query($this->conn,"SELECT COUNT(*) total FROM DELTAPLUS_PRODUCT WHERE DELTA_USER_ID = '$userId' AND SERIAL = '$serial'");
                while($row = mysqli_fetch_array($query)){
                    if($row['total']==0){
                        mysqli_query($this->conn,"INSERT INTO DELTAPLUS_PRODUCT(ID, PRODUCT, SERIAL, USERNAME, PROD_DATE, START_DATE, SAV1, SAV2, 
						SAV3, SAV4, SAV5, IS_DELETED, DELTA_USER_ID, CREATE_DATE, LAST_UPDATE_DATE) VALUES(null, '$production', '$serial', 
						'$user','$prod','$start','$sav1','$sav2','$sav3','$sav4','$sav5','$ifDelete','$userId',sysdate(),sysdate())");
                    }else{
                        mysqli_query($this->conn,"UPDATE DELTAPLUS_PRODUCT SET PRODUCT = '$production', USERNAME = '$user', PROD_DATE = '$prod', 
						START_DATE = '$start', SAV1 = '$sav1', SAV2 = '$sav2', SAV3 = '$sav3', SAV4 = '$sav4',
                        SAV5 = '$sav5', IS_DELETED = '$ifDelete', LAST_UPDATE_DATE = sysdate() WHERE DELTA_USER_ID = '$userId' AND SERIAL = '$serial'");
                    }
                }
			}
    	}
    }

    /**
    */
    function resetPassword($username, $password){
    	if(isset($username)){
			return $query = mysqli_query($this->conn,"update DELTAPLUS_USER set PASSWORD = '$password' WHERE LOGIN = '$username'");
		}

    }
}
