<!DOCTYPE html>
<html>
<?php
ini_set('display_errors', '0');
include 'autoload.php';
$servername = env('servername');
$username = env("username");
$password = env("password");
$dbname = env("dbname");
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    $conn = null;
    $conn = new mysqli($servername, $username, $password);
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
    $queries = explode(";", file_get_contents("createDatabase.sql"), -1);
    foreach ($queries as &$sql) {
        $result = $conn->query($sql);
    }
}
?>


<head>
    <title>Team Management Portal</title>
    <link rel="stylesheet" href="myStyle.css">
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="././dist/rss.global.min.js"></script>
    <script>
        function myLoad(siteName) {
            var loggedIn = getCookie("username");
            if (loggedIn === "") {
                siteName = "login";
            }
            $('#mainContainer').load("pages/" + siteName + ".php", function(data) {
                $.getScript("pages/" + siteName + ".js");
            });

        }
    </script>

</head>

<body>
    <script>
        $(document).ready(function() {
            var loggedIn = getCookie("username");
            if (loggedIn !== "") {
                myLoad('Home');
            } else {
                myLoad("Login");
            }
            $(".topnav a").click(function(e) {
                $('.topnav a.active').removeClass('active');
                $(this).addClass('active');
                e.preventDefault();
            });
        });
    </script>
    <div class="topnav">
        <a class="active" href="#home" onclick="javascript:myLoad('Home')">Home</a>
        <a href="#Players" onclick="javascript:myLoad('playerManagement')">Players</a>
        <a href="#Drills" onclick="javascript:myLoad('drillManagement')">Drills</a>
        <a href="#Planning" onclick="javascript:myLoad('teamPlanning')">Plan Team</a>
        <button id="logout" onclick="setCookie('username','',1); myLoad('Login')">Logout</button>
    </div>

    <div id=mainContainer></div>
    <div id="rss-feeds">
        <h2> Sports News</h2>
    </div>
    <script>
        const rss = new RSS(
            document.querySelector('#rss-feeds'),
            ["https://www.espn.com/espn/rss/news", "https://www.sportsnet.ca/feed/", "https://www.cbssports.com/rss/headlines/"], {
                limit: 4,
                entryTemplate: "<li><a href={url} >{title}</a><br>{shortBody}...<br></li>"
            }
        );
        rss.render()
            .then(() => console.log('cool'));

        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }
    </script>


</body>

</html>