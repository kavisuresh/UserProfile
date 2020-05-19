<?php
if ( isset($_ENV['host']) && isset($_ENV['port']) && isset($_ENV['MYSQL_DATABASE']) && isset($_ENV['MYSQL_USER']) && isset($_ENV['MYSQL_PASSWORD']) ){
  $host=$_ENV['MYSQL_SERVICE_HOST'];
  $port=$_ENV['MYSQL_SERVIE_PORT'];
  $dbname=$_ENV['MYSQL_DATABASE'];
  $username=$_ENV['MYSQL_USER'];
  $password=$_ENV['MYSQL_PASSWORD'];
  $pdo = new PDO('mysql:host='.$host.';port='.$port.';dbname='.$dbname.';',''.$username.'',''.$password.'',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
  $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
?>
