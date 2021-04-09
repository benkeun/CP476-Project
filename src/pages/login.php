<!DOCTYPE html>
<html>

<head>
    <title>BarDown Login</title>




</head>

<body>
    <h2>Please Login to access this page</h2>
    <?php if (isset($_COOKIE["loginError"])) {
        echo "<h4>Error with username, password combination</h4>";
    }
    ?>

    <p text-align='center'>Log In</p>
    <form action="pages/loginRequest.php" method="POST">
        <label for="name">Name:</label>
        <input name="name" id="name"><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password"><br>
        <input type="reset" value="Clear"><input type="submit" value="Login">
    </form>
    <h3> Create User if you do not have an account</h3>

    <?php if (isset($_COOKIE["databaseError"])) {
        echo "<h4>Error with account creation</h4>";
    }
    if (isset($_COOKIE["errorUserExists"])) {
        echo "<h4>User already Exists</h4>";
    }
    ?>
    <form action="pages/newUser.php" method="POST">
        <label for="username">Username:</label>
        <input name="username" id="username"><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password"><br>
        <input type="reset" value="Clear"><input type="submit" value="Signup">
    </form>

</body>


</html>