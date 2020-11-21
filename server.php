<?php
header('Content-Type: text/html; charset=utf-8');

  $address = '127.0.0.1'; 
  $port = readline("port: ");
  $key = readline("key: ");
  
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$bind = socket_bind($socket, $address, $port); 
$listen = socket_listen($socket, 5); 

do 
{
  echo "Ожидаем... \n";
  
  $accept = socket_accept($socket); 
  $msg = "Server OK \n"; 
  echo "Отправить клиенту \"".$msg."\"... "; socket_write($accept, $msg, strlen($msg)); 
  echo "OK \n";
  
while(true)
{
  $awr = socket_read($accept, 1024); 
  if (trim($awr) == "")
  {
    break; else echo "Client: ".decode($awr, $key)."\n";
    
    }
  }
} while(true);

if (isset($socket)) 
{
  echo "Закрываем соединение... "; 
  socket_close($socket); 
  echo "OK";
  
}  

function decode($encoded, $key){
$strofsym="qwertyuiopasdfghjklzxcvbnm1234567890QWERTYUIOPASDFGHJKLZXCVBNM=";
$x=0;
while ($x++<= strlen($strofsym)) {
$tmp = md5(md5($key.$strofsym[$x-1]).$key);
$encoded = str_replace($tmp[3].$tmp[6].$tmp[1].$tmp[2], $strofsym[$x-1], $encoded);
}
return base64_decode($encoded);
}