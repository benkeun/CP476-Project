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

<head>
    <title>Player Management</title>
</head>

<body>
    <h1>Players</h1>
    <button id = addPlayer onclick="addModal()">New Player</button>
    <br>
    <?php

    $sql = "SELECT * FROM players";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table id=players><thead><tr><th>First Name</th><th>Last Name</th><th>Number</th><th>Position</th><th>Points</th><th> + / - </th><th>Actions</th></tr></thead><tbody>";
        while ($row = $result->fetch_assoc()) {

            echo "<tr><td>" . $row['first_name'] . "</td><td>" . $row['last_name'] . "</td><td>" . $row['number'] . "</td><td>" . $row['position'] . "</td><td>" . $row['points'] . "</td><td>" . $row['plus_minus'] . "</td><td><button onClick='deletePlayer(" . $row['number'] . ")'>Delete</button><button class = leftMarginBtn onClick='editModal(" . $row['number'] . ")'>Edit</button></td></tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "\nError: " . $conn->error;
    }
    ?>

    <script>
        var myTable = $('#players').DataTable({
            paging: true
        });
    </script>
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id=status>Update Row</p>
            <label>First Name</label>
            <input id='firstName' style = "margin:0px 0px 5px 0px" type='text'></input><br>
            <label>Last Name</label>
            <input id='lastName' style = "margin:0px 0px 5px 1px" type='text'></input><br>
            <label>Position</label>
            <select id='position' style = "margin:0px 0px 5px 20px" type='text'>
        <option value="Center">Center</option>
        <option value="Right Wing">Right Wing</option>
        <option value="Left Wing">Left Wing</option>
        <option value="Left Defense">Left Defense</option>
        <option value="Right Defense">Right Defense</option>
        <option value="Goalie">Goalie</option>
        </select><br>
            <label>Points</label>
            <input id='points' style = "margin:0px 0px 5px 33px" type='text'></input><br>
            <label>+ / -</label>
            <input id='plusMinus' style = "margin:0px 0px 5px 46px" type='text'></input><br>
            <input id='row' type='hidden'></input>
            <input id='id' type='hidden'></input>
            <button id=updateBtn onclick="edit()">Update</button>

        </div>
    </div>
    <div id="myAddModal" class="addModal">
        <div class="addModal-content">
            <span class="close">&times;</span>
            <p id=addStatus>Add Row</p>
            <label>First Name</label>
            <input id='addFirstName'  style = "margin:0px 0px 5px 0px" type='text'></input><br>
            <label>Last Name</label>
            <input id='addLastName'  style = "margin:0px 0px 5px 2px" type='text'></input><br>
            <label>Number</label>
            <input id='addId'   style = "margin:0px 0px 5px 20px"type='number'></input><br>
            <label>Position</label>
            <select id='addPosition' style = "margin:0px 0px 5px 20px" type='text'>
        <option value="Center">Center</option>
        <option value="Right Wing">Right Wing</option>
        <option value="Left Wing">Left Wing</option>
        <option value="Left Defense">Left Defense</option>
        <option value="Right Defense">Right Defense</option>
        <option value="Goalie">Goalie</option>
        </select><br>
            <label>Points</label>
            <input id='addPoints' style = "margin:0px 0px 5px 33px" type='number'></input><br>
            <label>+ / -</label>
            <input  id='addPlusMinus' style = "margin:0px 0px 5px 46px" type='number'></input><br>

            <button id=addBtn onclick="add()">Add</button>

        </div>

    </div>
</body>

</html>