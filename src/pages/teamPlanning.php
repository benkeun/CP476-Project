<!DOCTYPE html>
<?php
include '../autoload.php';
$servername = env('servername');
$username = env("username");
$password = env("password");
$dbname = env("dbname");
$conn = new mysqli($servername, $username, $password, $dbname);
$max=0;
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
                $max=$row['MAX(line_num)'];
                for ($i = 1; $i <= $max; $i++) {
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
            <button class="bottomMarginBtn" onclick="editDisplays()">Edit Custom Lines</button>
        </div>

        <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <h4 id ="status">Edit Lines</h4>
                <select id="customLineupType" onchange="editDisplays()">
                    <option value="New">New</option>
                    <?php
                    $sql = "SELECT distinct lineup_type FROM lineups WHERE lineup_type NOT in ('Power','Defensive','Balanced')";
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
                <select id="customLineNum", onchange="editDisplays()">
                    <?php
                        for ($i = 1; $i <= $max; $i++) {
                            echo "<option value=$i>$i</option>";
                        }
                    ?>
                </select>
                <label for="lineName">Line Name</label>
                <input id = "lineName" ></input>
                <table>
                    <tr>
                        <th>Position</th>
                        <th>Player</th>
                    </tr>
                    <tr id=leftWingEdit>
                        <td>Left Wing</td>
                        <td><Select id="leftSelect"></Select></td>

                    </tr>
                    <tr id="centerEdit">
                        <td>Center</td>
                        <td><Select id="centerSelect"></Select></td>
                    </tr>
                    <tr id="rightWingEdit">
                        <td>Right Wing</td>
                        <td><Select id="rightSelect"></Select></td>
                    </tr>
                    <tr id="leftDefenseEdit">
                        <td>Left Defense</td>
                        <td><Select id="leftDSelect"></Select></td>

                    </tr>
                    <tr id="rightDefenseEdit">
                        <td>Right Defense</td>
                        <td><Select id="rightDSelect"></Select></td>
                    </tr>
                </table>
                <button id=updateBtn onclick="updateLine(0)">Update</button>  <button id=deleteBtn onclick="updateLine(1)">Delete Lineup</button>

            </div>
        </div>
    </div>
</body>

</html>