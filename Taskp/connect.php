<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'crud_in_ci';

$conn = mysqli_connect($hostname,$username,$password,$database);

if(!$conn){
echo "connection failed" .$conn;
}
?> 