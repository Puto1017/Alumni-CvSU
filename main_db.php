<?php
require_once 'admin/Security-Files.php';

$host = 'localhost'; 
$user = 'root'; 
$password = ''; 
$database = 'room_reservation'; 

$mysqli = new mysqli($host, $user, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>