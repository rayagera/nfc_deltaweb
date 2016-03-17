<html>
<body>

<?php



if (isset($_REQUEST['email']))
//if "email" is filled out, send email
  { ini_set();
  //send email
  $email = $_REQUEST['email'] ; 
  $subject = $_REQUEST['subject'] ;
  $message = $_REQUEST['message'] ;
	ini_set('SMTP','smtp.mandrillapp.com');//发件SMTP服务器  
	ini_set('smtp_port',587);//发件SMTP服务器端口
	ini_set('sendmail_from',"gerardo.garzaa@gmail.com");//发件人邮箱 

  mail( $email, "Subject: $subject",
  $message, "From: $email" );
  echo "Thank you for using our mail form";
  }
else
//if "email" is not filled out, display the form
  {
  echo "<form method='post' action='mail_form.php'>
  Email: <input name='email' type='text' /><br />
  Subject: <input name='subject' type='text' /><br />
  Message:<br />
  <textarea name='message' rows='15' cols='40'>
  </textarea><br />
  <input type='submit' />
  </form>";
  }
?>

</body>
</html>