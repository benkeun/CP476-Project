<?php
include '../autoload.php';
$servername = env('servername');
$username = env("username");
$password = env("password");
$dbname = env("dbname");
$conn = new mysqli($servername, $username, $password, $dbname);
$playerArray = array();
$lineType = $_POST["type"];

switch ($lineType) {
    case "Power":
        $sql = $sql = "SELECT * FROM players WHERE NOT position='Goalie' ORDER BY position ASC, points DESC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($playerArray, $row);
            }
        } else {
            echo -1;
        }
        pushLine($playerArray,"Power");
        break;
    case "Balanced":
        $sql = $sql = "SELECT * FROM players WHERE NOT position='Goalie' ORDER BY position ASC, (plus_minus+points)/(points-plus_minus) DESC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($playerArray, $row);
            }
        } else {
            echo -1;
        }
        pushLine($playerArray,"Balanced");
        break;
    case "Defensive":
        $sql = $sql = "SELECT * FROM players WHERE NOT position='Goalie' ORDER BY position ASC, plus_minus DESC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($playerArray, $row);
            }
        } else {
            echo -1;
        }
        pushLine($playerArray,"Defensive");
        break;
    case "custom":

        break;
}

function pushLine($playerArr, $type)
{
    $success=1;
    $position = "";
    $lineNum = 1;
    $sql="DELETE FROM lineups WHERE lineup_type='$type';";
    $GLOBALS["conn"]->query($sql);
    for ($i = 0; $i < count($playerArr); $i++) {
        if (strcmp($position, $playerArr[$i]["position"]) === 0) {
            $sql = "INSERT INTO lineups (lineup_type, line_num, player_num) VALUES ('$type', $lineNum, ".$playerArr[$i]["number"].");";
            $lineNum++;
        } else {
            $position = $playerArr[$i]["position"];
            $lineNum = 1;
            $sql = "INSERT INTO lineups (lineup_type, line_num, player_num) VALUES ('$type', $lineNum, ".$playerArr[$i]["number"].");";
            $lineNum++;
        }
        $result = $GLOBALS["conn"]->query($sql);
        if($result!=1){
            
            $success=0;
        }
    }
    echo $success;

}
?>