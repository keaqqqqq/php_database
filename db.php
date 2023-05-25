<?php
$host = 'localhost'; // replace with your database host
$db = 'student'; // replace with your database name
$user = 'root'; // replace with your database username
$password = ''; // replace with your database password

$connection = new PDO("mysql:host=$host;dbname=$db", $user, $password);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>