<?php
 
/*//echo(rand());
//echo(rand());
echo( ' --- ' . chr(rand(90,90)));
echo( ' --- ' . chr(rand(97,97)));

$utils = new PHPUtils();
$val = $utils->getRadom(3);
echo(' --- ' . $val);
 */
 
class PHPUtils
{
    /**
     * The PHPMailer Version number.
     * @var string
     */
    public $Version = '5.2.13';
    /**
     * Actually send a message.
     * Send the email via the selected mechanism
     * @throws phpmailerException
     * @return boolean
     */
    public function getRadom($pw_length )
    {
            $randpwd = '';  
            for ($i = 0; $i < $pw_length; $i++)  
            {  
                $randpwd .= chr(mt_rand(65, 90));
                $randpwd .= chr(mt_rand(97, 122));  
            }  
            return $randpwd;  
    }  
    // 调用该函数，传递长度参数$pw_length = 6 
}

?>