#php异步的尝试

因项目中要用到调用短信接口，考虑到用户使用的感受，故考虑将短信发送的方式改为异步调用。

**网上异步的框架有 gearman swoole** 但由于业务需求不是很复杂，故采用了相对简单的  fsockopen()函数进行调用。

贴上代码：
	

```
fscokopen.php文件
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
```


```
async.php文件

<?php
sleep(20);
file_put_contents('./test.txt', 'async ok');
```


**在被调用的文件中sleep()20秒，模拟程序处理时间，
而在fscokopen文件中，开始与结束间隔1秒左右， 证明异步调用成功，没有阻塞程序执行。**
