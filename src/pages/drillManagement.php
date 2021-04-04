<!DOCTYPE html>
<html>

<head>
    <title>Drill Management</title>




</head>

<body>
    <p>Full Ice Exercises</p>
    <button type="radio" name="background" onclick="changeBackground(backgroundFull)">Full Ice</button>
    <button type="radio" name="background" onclick="changeBackground(backgroundHalf)">Half Ice</button>
    <div id="drillDiv">
        <canvas id="drillCanvas" height="550" width="1200"></canvas>
    </div>
    <button type="radio" name="mode" onclick="changeMode(circleMode)">Circle</button>
    <button type="radio" name="mode" onclick="changeMode(crossMode)">Cross</button>
    <button type="radio" name="mode" onclick="changeMode(linesMode)">Lines</button>
    <button type="radio" name="mode" onclick="changeMode(eraseMode)">Erase</button>
    
    <p>Plan Drills</p>


</body>

</html>