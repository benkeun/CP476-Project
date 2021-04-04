<?php
include '../autoload.php';
$servername = env('servername');
$username = env("username");
$password = env("password");
$dbname = env("dbname");
$conn = new mysqli($servername, $username, $password, $dbname);

$sql="SELECT lineups.* , players.first_name, players.last_name, players.position FROM (lineups INNER JOIN players ON lineups.player_num = players.number)";
$result=$conn->query($sql);
if ($result->num_rows > 0) {
    $rows= array();
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    echo json_encode($rows);
}
?>