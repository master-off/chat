<?php
 
  $address = readline("server: ");
  $port = readline("port: ");
  $msg = readline("msg: ");
  $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
   
  socket_connect($socket, $address, $port);
  socket_write($socket, "GET / HTTP/1.0 TEXT:".$msg."\r\n\r\n");
   
  $result = "";
   
  while($read = socket_read($socket, 1024))
  {
    $result .= $read; 
  }
  socket_close($socket);
   
  echo "Полученный результат:  $result\r\n"; 
   
?> 
