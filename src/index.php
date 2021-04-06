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
            $('#mainContainer').load("pages/" + siteName + ".php", function(data) {
                $.getScript("pages/" + siteName + ".js");
            });

        }
    </script>

</head>

<body>
    <script>
        $(document).ready(function() {
            myLoad('Home');
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
    </div>

    <div id=mainContainer></div>
    <div id="rss-feeds">
        <h2> Sports News</h2>
    </div>
    <script>
        const rss = new RSS(
            document.querySelector('#rss-feeds'),
            "https://www.sportsnet.ca/feed?format=xml", {
                limit: 10,
                entryTemplate:
                "<li><a href={url} >{title}</a><br>{shortBody}...<br></li>"
            }
        );
        rss.render()
            .then(() => console.log('cool'));
    </script>


</body>

</html>