<!DOCTYPE html>
<?php
include '../autoload.php';
$servername = env('servername');
$username = env("username");
$password = env("password");
$dbname = env("dbname");
$conn = new mysqli($servername, $username, $password, $dbname);
?>

<html>
    <head><title>Home Page</title></head>
    <body>
       <h1> Your Bar Down Summary</h1>
        <?php 
        $sql="Select COUNT(*) FROM players";
        $result=$conn->query($sql);
        $count=$result->fetch_assoc()["COUNT(*)"];
        echo "<h3> Your team currently has $count players</h3>";
        echo "<table><tr><th>Position</th><th>Count</th><th>Average Points</th><th>Average Plus Minus</th></tr>";
        $sql="Select position, COUNT(*), AVG(points) as pts, AVG(plus_minus) as plusMinus FROM players GROUP BY position ORDER BY pts";
        $result=$conn->query($sql);
        while($count=$result->fetch_assoc() ){
        echo "<tr><td>".$count['position']."</td><td>".$count["COUNT(*)"]."</td><td>".round($count["pts"],2)."</td><td>".round($count["plusMinus"],2)."</td></tr>";
        }
        echo"</table>";
        $sql="Select COUNT(DISTINCT lineup_type)FROM lineups";
        $result=$conn->query($sql);
        $count=$result->fetch_assoc();
        echo "<h3> Your team currently has ".$count["COUNT(DISTINCT lineup_type)"]." lineups</h3>";

        $sql="Select DISTINCT lineup_type FROM lineups ORDER BY lineup_type";
        $result=$conn->query($sql);
        echo "<table><tr><th>Lineup Name</th></tr>";
        while($count=$result->fetch_assoc()){
            echo "<tr><td>".$count["lineup_type"]."</td></tr>";
        }
        echo "</table>";

        ?>
    </body>
</html>