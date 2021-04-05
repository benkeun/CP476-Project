<!DOCTYPE html>
<html>

<head>
    <title>Drill Management</title>




</head>

<body>
    <p>Full Ice Exercises</p>
    <input type="radio" name="background" value="ice" onclick="changeBackground('images/ice.jpg')" checked>Full Ice</input>
    <input type="radio" name="background" value= "halfIce" onclick="changeBackground('images/halfIce.jpg')">Half Ice</input>
    <div id="drillDiv">
        <canvas id="drillCanvas" height="500" width="1165"></canvas>
    </div>
    <input type="radio" name="mode" onclick="changeMode(circleMode)">Circle</input>
    <input type="radio" name="mode" onclick="changeMode(crossMode)">Cross</input>
    <input type="radio" name="mode" onclick="changeMode(linesMode)" checked>Lines</input>
    <input type="radio" name="mode" onclick="changeMode(eraseMode)">Erase</input>
    
    <p>Plan Drills</p>


</body>


</html>