<!DOCTYPE html>

<head>
    <title>Add User</title>
</head>

<body>
    <?php
    include '../autoload.php';
    $name = $_POST['username'];
    $userpassword = sha1($_POST['password']);

    $servername = env('servername');
    $username = env("username");
    $password = env("password");
    $dbname = env("dbname");
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
    $sql = "SELECT * FROM users WHERE username='$name'";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        $sql = "INSERT INTO users (username,password) VALUES ('$name', '$userpassword')";
        $result=$conn->query($sql);
        if ($result === TRUE) {
            header("Location: ../");
        } else{
            setcookie("databaseError", 1, time() + (30), "/");
            header("Location: ../");
        }
    } else {
            setcookie("errorUserExists", 1, time() + (30), "/");
            header("Location: ../");
            
    }

    $conn->close();

    ?>

</body>

</html>