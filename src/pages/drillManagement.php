<!DOCTYPE html>
<html>
<?php
include '../autoload.php';
$servername = env('servername');
$username = env("username");
$password = env("password");
$dbname = env("dbname");
$conn = new mysqli($servername, $username, $password, $dbname);
?>

<head>
    <title>Drill Management</title>




</head>

<body>
    <p>Full Ice Exercises</p>
    <label>Drill Name:</label>
    <input id="drillName" type="text" value="">
    <label>Category:</label>
    <select name="drillCategory" id="drillCategory">
        <option value="skating">Skating</option>
        <option value="passing">Passing</option>
        <option value="shooting">Shooting</option>
    </select>
    <input type="submit" onclick="addDrill()" value="Submit">

    <div id="drillDiv">
        <canvas id="drillCanvas" height="500" width="1165"></canvas>
    </div>
    <input type="radio" name="mode" onclick="changeMode(circleMode)">Circle</input>
    <input type="radio" name="mode" onclick="changeMode(crossMode)">Cross</input>
    <input type="radio" name="mode" onclick="changeMode(lineMode)" checked>Lines</input>
    <input type="radio" name="mode" onclick="changeMode(eraseMode)">Erase</input>
    <button onclick="resetCanvas()">Reset</button>
    <p>Plan Drills</p>
    <?php

    $sql = "SELECT * FROM drills    ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table id=drillTable><thead><tr><th>Name</th><th>Category</th></tr></thead><tbody>";
        while ($row = $result->fetch_assoc()) {

            echo "<tr><td><a href='javascript:void(0)' onclick='loadCanvas()'>" . $row['name'] . "</a></td><td>" . $row['category']."</td></tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "\nError: " . $conn->error;
    }
    ?>


    <script>
        var myTable = $('#drillTable').DataTable({
            paging: true
        });
    </script>

</body>


</html>