<?php
//to connect to the database
$host = 'localhost';
$dbname = 'login_registration';
$dbusername = 'root';
$dbpassword = '';

$mysqli = new mysqli(hostname: $host, username: $dbusername, password: $dbpassword, database: $dbname);

if($mysqli->connect_errno){
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;

