<?php 

/**
 * 使用fscokopen实现简单的PHP异步
 * 
 */

echo 'start'.microtime().'<br>'; 

 $fp = fsockopen('learn.com', '80', $errno, $error);

 if(!$fp){
 	echo 'open failed '.$errno.'----'.$error;
 	exit;
 }

// 拼接header
$header = "GET /async/async.php HTTP/1.1\r\n";
$header .= "Host: learn.com\r\n";
$header .= "Connection: close\r\n\r\n";

fwrite($fp, $header);

fclose($fp);


echo 'end'.microtime();