<?php
declare(strict_types = 1);

$db['db_host'] = 'localhost';        // we create an array of database login data
$db['db_username'] = 'wipaka_rajczogli';
$db['db_password'] = 'kauczuk1';
$db['db_database'] = 'cmd_udemy';

foreach ($db as $key => $value) {      // then we convert each index into an constant
  define(strtoupper($key),$value);
}
$link = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_DATABASE);      // a secure way to connect to database is to use constants

mysqli_set_charset($link,"utf8");      // additional query for polish characters

if(!$link){
  echo "Error";
}

session_start();
$username = (isset($_SESSION['username'])) ? $_SESSION['username'] : '';
$role = (isset($_SESSION['role'])) ? $_SESSION['role'] : '';
$query = "SELECT `users`.`role` FROM `users` WHERE `users`.`username` = '$username'";
$result = mysqli_fetch_assoc(mysqli_query($link,$query));
if($result['role'] != $role){
  header('location: logout.php');
}
session_abort();

 ?>
