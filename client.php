<?php
header('Content-Type: text/html; charset=utf-8');

  $address = '127.0.0.1'; 
  $port = readline("port: "); 
  $key = readline("key: ");

echo "Create Chat... \n"; 
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

$connect = socket_connect($socket, $address, $port);

while(true)
{
  $msg = readline("msg: ");
  if($msg)
{
  socket_write($socket, encode($msg, $key), strlen(encode($msg, $key)));
  }
}
if(isset($socket)) 
{
  echo "Закрываем соединение... \n";
  socket_close($socket); 
  echo "OK \n";
  
}

function encode($unencoded,$key){
$string=base64_encode($unencoded);

$arr=array();
$x=0;
while ($x++< strlen($string)) {
$arr[$x-1] = md5(md5($key.$string[$x-1]).$key);
$newstr = $newstr.$arr[$x-1][3].$arr[$x-1][6].$arr[$x-1][1].$arr[$x-1][2];
}
return $newstr;
}
 