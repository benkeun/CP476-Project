<?php
include '../autoload.php';
$servername = env('servername');
$username = env("username");
$password = env("password");
$dbname = env("dbname");
$conn = new mysqli($servername, $username, $password, $dbname);

$sql="UPDATE players SET first_name = '".$_POST['firstName']."', last_name = '".$_POST['lastName']."',position = '".$_POST['position']."',points = '".$_POST['points']."',plus_minus = '".$_POST['plusMinus']."'WHERE number = '".$_POST['number']."'; ";
$result=$conn->query($sql);
echo $result;
?>