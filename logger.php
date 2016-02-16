<?php
class logger{
	/*
	*/
	const log_file = 'log.log'; 

	function __construct(){
	}

	function info( $msg) {
		$showtime=date("Y-m-d H:i:s");
		//echo "********" . $showtime . " --- type : " . $type .  " --- " . $data ."\n";
		$f  = file_put_contents(self::log_file,$showtime . "---- info --- " . $msg .  " --- " ."\n",FILE_APPEND);// 这个函数支持版本(PHP 5) 
	}


	function debug( $msg) {
		$showtime=date("Y-m-d H:i:s");
		//echo "********" . $showtime . " --- type : " . $type .  " --- " . $data ."\n";
		$f  = file_put_contents(self::log_file,$showtime . "---- debug --- " . $msg .  " --- " ."\n",FILE_APPEND);// 这个函数支持版本(PHP 5) 
	}
}