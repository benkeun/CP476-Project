<?php
include '../autoload.php';
$servername = env('servername');
$username = env("username");
$password = env("password");
$dbname = env("dbname");
$conn = new mysqli($servername, $username, $password, $dbname);

$sql="INSERT INTO players (first_name, last_name,position, number, points, plus_minus) VALUES ('".$_POST['firstName']."', '".$_POST['lastName']."', '".$_POST['position']."', '".$_POST['number']."', '".$_POST['points']."', '".$_POST['plusMinus']."');";
$result=$conn->query($sql);
echo $result;

?>