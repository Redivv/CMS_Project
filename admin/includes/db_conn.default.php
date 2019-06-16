<?php
declare(strict_types = 1);
include ('C:\xampp\htdocs\Projects\CMS_Project\admin\processing\functions.php');
ob_start();      // aktywuje output buffering przez co output ze skryptu poza header jest blokowany

$db['db_host'] = '';        // we create an array of database login data
$db['db_username'] = '';
$db['db_password'] = '';
$db['db_database'] = '';

foreach ($db as $key => $value) {      // then we convert each index into an constant
  define(strtoupper($key),$value);
}
$link = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_DATABASE);      // a secure way to connect to database is to use constants

mysqli_set_charset($link,"utf8");      // additional query for polish characters

if(!$link){
  echo "Error";
}
 ?>
