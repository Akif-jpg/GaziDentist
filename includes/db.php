<?php
ob_start();

$db['db_host'] = "localhost";
$db['db_user'] = "admin";
$db['db_pass'] = "password";
$db['db_name'] = "gazident_blog";

foreach($db as $key => $value){
    define(strtoupper($key),$value);
}

$connection = mysqli_connect($db['db_host'],$db['db_user'],$db['db_pass'],$db['db_name']);

?>
