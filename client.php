<?php
header('Content-Type:text/html; charset=utf-8');
$data = readline("enter (ip:port)): ");
$dataa = explode(":", $data);
 $address = $dataa[0];
 $port = $dataa[1];
 $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
 $connect = socket_connect($socket, $address, $port);

while(true){
 $msg = readline("sms: ");
socket_write($socket, $msg, strlen($msg));
	
}
 
 if(isset($socket))  {
	echo "Закрываем соединение... ";
 	socket_close($socket);
 	echo "OK";
}
 ?>
