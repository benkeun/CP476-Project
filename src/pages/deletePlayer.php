<?php
include '../autoload.php';
$servername = env('servername');
$username = env("username");
$password = env("password");
$dbname = env("dbname");

$conn = new mysqli($servername, $username, $password, $dbname);
$result=$conn->query("DELETE FROM players WHERE number = ".$_POST['id']);
?>
