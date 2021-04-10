<?php
include '../autoload.php';
$servername = env('servername');
$username = env("username");
$password = env("password");
$dbname = env("dbname");
$conn = new mysqli($servername, $username, $password, $dbname);

$sql="INSERT INTO drills (name, category,canvas, description) VALUES ('".$_POST['drillName']."', '".$_POST['drillCategory']."', '".$_POST['canvas']."', '".$_POST['description']."');";
$result=$conn->query($sql);
$result=$conn->query("SELECT id FROM drills WHERE name='".$_POST['drillName']."' AND category='".$_POST['drillCategory']."'");
echo $result->fetch_assoc()['id'];

?>