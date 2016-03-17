
<?PHP

header('Content-Type:application/json');
header('Access-Control-Allow-Origin:*');
date_default_timezone_set("PRC");

//引入PHPMailer的核心文件 使用require_once包含避免出现PHPMailer类重复定义的警告
require_once("phpmailer/class.phpmailer.php"); 
require 'phpmailer/PHPMailerAutoload.php';
include('phpmailer/class.smtp.php');  
include('phpmailer/class.phputil.php');  

if(strlen(session_id())<1){
	session_start();
}

$resource="";
if(isset($_POST['resource'])){
	$resource = $_POST['resource'];
}

$utils = new PHPUtils();

$secCode = $utils->getRadom(3);
$_SESSION['secCode'] = $secCode;

$emailAddress;

if(isset($_SESSION['email'])){
	$emailAddress = $_SESSION['email'];
}

if(!isset($emailAddress) && isset($_POST['email'])){
	$emailAddress = $_POST['email'];
}

//$res = array('status'=>'OK');

//示例化PHPMailer核心类
$mail = new PHPMailer();
 
//是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
$mail->SMTPDebug = 0;
 
//使用smtp鉴权方式发送邮件，当然你可以选择pop方式 sendmail方式等 本文不做详解
//可以参考http://phpmailer.github.io/PHPMailer/当中的详细介绍
$mail->isSMTP();
//smtp需要鉴权 这个必须是true
$mail->SMTPAuth=true;
//链接qq域名邮箱的服务器地址

/*
$mail->Host = 'smtp.mandrillapp.com';
//设置使用ssl加密方式登录鉴权
$mail->SMTPSecure = 'tls'; //'ssl';
//设置ssl连接smtp服务器的远程服务器端口号 可选465或587
$mail->Port = 587;
//设置smtp的helo消息头 这个可有可无 内容任意
//$mail->Helo = 'Hello smtp.qq.com Server';
//设置发件人的主机域 可有可无 默认为localhost 内容任意，建议使用你的域名
$mail->Hostname = 'localhost';
//设置发送的邮件的编码 可选GB2312 我喜欢utf-8 据说utf8在某些客户端收信下会乱码
$mail->CharSet = 'UTF-8';
//设置发件人姓名（昵称） 任意内容，显示在收件人邮件的发件人邮箱地址前的发件人姓名
$mail->FromName = 'NFC Delta ID CARD';
//smtp登录的账号 这里填入字符串格式的qq号即可
$mail->Username ='gerardo.garzaa@gmail.com';
//smtp登录的密码 这里填入“独立密码” 若为设置“独立密码”则填入登录qq的密码 建议设置“独立密码”
$mail->Password = 'H_9XPbomdCiLyhq2Jb_v8w';
//设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
$mail->From = 'gerardo.garzaa@gmail.com';
*/
$mail->Host = 'smtp.126.com';
//设置使用ssl加密方式登录鉴权
//$mail->SMTPSecure = 'ssl';
//设置ssl连接smtp服务器的远程服务器端口号 可选465或587
$mail->Port = 25;
//设置smtp的helo消息头 这个可有可无 内容任意
//$mail->Helo = 'Hello smtp.126.com Server';
//设置发件人的主机域 可有可无 默认为localhost 内容任意，建议使用你的域名
$mail->Hostname = '默认为localhost';
//设置发送的邮件的编码 可选GB2312 我喜欢utf-8 据说utf8在某些客户端收信下会乱码
$mail->CharSet = 'UTF-8';
//设置发件人姓名（昵称） 任意内容，显示在收件人邮件的发件人邮箱地址前的发件人姓名
$mail->FromName = 'Delta Web';
//smtp登录的账号 这里填入字符串格式的qq号即可
$mail->Username ='ywkmc@126.com';
//smtp登录的密码 这里填入“独立密码” 若为设置“独立密码”则填入登录qq的密码 建议设置“独立密码”
$mail->Password = '126@ykk0514';
//设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
$mail->From = 'ywkmc@126.com';


//邮件正文是否为html编码 注意此处是一个方法 不再是属性 true或false
$mail->isHTML(true); 
//设置收件人邮箱地址 该方法有两个参数 第一个参数为收件人邮箱地址 第二参数为给该地址设置的昵称 不同的邮箱系统会自动进行处理变动 这里第二个参数的意义不大
//$mail->addAddress('yangguoyk@qq.com','晶晶在线用户');
//添加多个收件人 则多次调用方法即可
$mail->addAddress($emailAddress,$emailAddress);
//添加该邮件的主题
$mail->Subject = 'Delta Security Validation';
//添加邮件正文 上方将isHTML设置成了true，则可以是完整的html字符串 如：使用file_get_contents函数读取本地的html文件
$mail->Body = "<h3> Thanks for using delta production.</h3> <br> Please copy fill the form input with following security code and click next step." 
	. " <br><b>" .$secCode ."</b>";
//为该邮件添加附件 该方法也有两个参数 第一个参数为附件存放的目录（相对目录、或绝对目录均可） 第二参数为在邮件附件中该附件的名称
//$mail->addAttachment('./d.jpg','mm.jpg');
//同样该方法可以多次调用 上传多个附件
//$mail->addAttachment('./Jlib-1.1.0.js','Jlib.js');
 
 
//发送命令 返回布尔值 
//PS：经过测试，要是收件人不存在，若不出现错误依然返回true 也就是说在发送之前 自己需要些方法实现检测该邮箱是否真实有效
$status = $mail->send();
 
//简单的判断与提示信息
if($status) {
	 //echo 'Email has been sent to your email (' .$emailAddress .') successfully, please check your email.';
	 $res = array("message" => 'Email has been sent to your email (' .$emailAddress .') successfully, please check your email.',
	 				 "secCode" => $secCode);
	 if($resource=='mobile'){
	 	echo json_encode($res);
	 } else {
	 	echo 'Email has been sent to your email (' .$emailAddress .') successfully, please check your email.';
	 }
}else{
	 $res = array("message" => 'Failed to send email (' .$emailAddress .'). please try again. If issue still present, please contact our IT support.',
	 				"secCode" => '');
	 if($resource=='mobile'){
	 	echo json_encode($res);
	 } else {
	 	echo 'Failed to send email (' .$emailAddress .'). please try again. If issue still present, please contact our IT support.';
	 }
 	
}
?>