<!DOCTYPE html>

<head>
  <title>Login</title>
</head>

<body>
<?php
include '../autoload.php';
$name = $_POST['name'];
$userpassword = sha1($_POST['password']);

$servername = env('servername');
$username = env("username");
$password = env("password");
$dbname = env("dbname");
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
$sql = "SELECT * FROM users WHERE username = '$name'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['password']!=$userpassword){
                echo "<p>".$row['password']."Incorrect name or password<p>".$userpassword;
            }
            else{
           
$cookie_name = "username";
$cookie_value = $name;
$cookie_pass = "password";
$cookie_pass_value = $userpassword;
setcookie($cookie_name, $cookie_value, time() + (600), "/"); // 86400 = 1 day
setcookie($cookie_pass, $cookie_pass_value, time() + (600), "/"); // 86400 = 1 day
                    header("Location: ../");



            }

        }else{
            setcookie("loginError", 1, time() + (30), "/");
            header("Location: ../");

        }

$conn->close();

?>

</body>
</html>