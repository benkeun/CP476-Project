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
<title>Plan Team</title>

</head>

<body>
    <h2>Select Line</h2>
    <div>
        <select id=lineupType onchange="displayLine()">
            <?php
            $sql = "SELECT distinct lineup_type FROM lineups";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value=" . $row['lineup_type'] . ">" . $row['lineup_type'] . "</option>";
                }
            } else {
                echo "SQL Error, Reload";
            }

            ?>
        </select>
        <select id=lineNum onchange="displayLine()">
            <?php
            $sql = "SELECT MAX(line_num) FROM lineups";
            $result = $conn->query($sql);
            if ($result) {
                $row = $result->fetch_assoc();
                for ($i = 1; $i <= $row['MAX(line_num)']; $i++) {
                    echo "<option value=$i>$i</option>";
                }
            } else {
                echo "<option value=1>1</option>";
            }
            ?>
        </select>

    </div>
    <div id="positionDiv">
        <span id="rightWingSpan"></span>
        <span id="centerSpan"></span>
        <span id="leftWingSpan"></span>
        <span id="leftDefenseSpan"></span>
        <span id="rightDefenseSpan"></span>
    </div>
    <div class=grid-container>
        <div class="grid-table">
            <table>
                <tr>
                    <th>Position</th>
                    <th>Name</th>
                    <th>Number</th>
                </tr>
                <tr id=leftWingName>
                    <td>Left Wing</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr id="centerName">
                    <td>Center</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr id="rightWingName">
                    <td>Right Wing</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr id="leftDefenseName">
                    <td>Left Defense</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr id="rightDefenseName">
                    <td>Right Defense</td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
        <div class="grid-buttons">
            <button class="bottomMarginBtn" onclick="generateLines('Balanced')">Update Balanced Line</button>
            <button class="bottomMarginBtn" onclick="generateLines('Defensive')">Update Defensive Line</button>
        </div>
        <div class="grid-buttons">
            <button class="bottomMarginBtn" onclick="generateLines('Power')">Update Power Line</button>
            <button class="bottomMarginBtn">Create Custom Line</button>
        </div>


    </div>
</body>

</html>