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
    <button onclick="addModal()">New Player</button>
    <br>
    <?php

    $sql = "SELECT * FROM players";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table id=players><thead><tr><th>First Name</th><th>Last Name</th><th>Number</th><th>Position</th><th>Points</th><th> + / - </th><th>Actions</th></tr></thead><tbody>";
        while ($row = $result->fetch_assoc()) {

            echo "<tr><td>" . $row['first_name'] . "</td><td>" . $row['last_name'] . "</td><td>" . $row['number'] . "</td><td>" . $row['position'] . "</td><td>" . $row['points'] . "</td><td>" . $row['plus_minus'] . "</td><td><button onClick='deletePlayer(" . $row['number'] . ")'>Delete</button><button onClick='editModal(" . $row['number'] . ")'>Edit</button></td></tr>";
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
            <input id='firstName' type='text'></input>
            <label>Last Name</label>
            <input id='lastName' type='text'></input>
            <label>Position</label>
            <input id='position' type='text'></input>
            <label>Points</label>
            <input id='points' type='text'></input>
            <label>+ / -</label>
            <input id='plusMinus' type='text'></input>
            <input id='row' type='hidden'></input>
            <input id='id' type='hidden'></input>
            <button id=updateBtn onclick="edit()">Update</button>

        </div>
    </div>
    <div id="myAddModal" class="addModal">
        <div class="addModal-content">
            <span class="close">&times;</span>
            <p id=addStatus>Update Row</p>
            <label>First Name</label>
            <input id='addFirstName' type='text'></input>
            <label>Last Name</label>
            <input id='addLastName' type='text'></input>
            <label>Number</label>
            <input id='addId' type='number'></input>
            <label>Position</label>
            <input id='addPosition' type='text'></input>
            <label>Points</label>
            <input id='addPoints' type='number'></input>
            <label>+ / -</label>
            <input id='addPlusMinus' type='number'></input>

            <button id=addBtn onclick="add()">Add</button>

        </div>

    </div>
</body>

</html>