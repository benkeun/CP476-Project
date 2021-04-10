<!DOCTYPE html>
<html>

<head>
    <title>Drill Management</title>




</head>

<body>
    <p>Full Ice Exercises</p>
    <label>Drill Name:</label>
    <input id = "drillName" type="text" value = "">
    <label>Category:</label>
    <select name="drillCategory" id="drillCategory">
        <option value="skating">Skating</option>
        <option value="passing">Passing</option>
        <option value="shooting">Shooting</option>
    </select>
    <input type="submit" onclick="addDrill()" value="Submit">

    <div id="drillDiv">
        <canvas id="drillCanvas" height="500" width="1165"></canvas>
    </div>
    <input type="radio" name="mode" onclick="changeMode(circleMode)">Circle</input>
    <input type="radio" name="mode" onclick="changeMode(crossMode)">Cross</input>
    <input type="radio" name="mode" onclick="changeMode(lineMode)" checked>Lines</input>
    <input type="radio" name="mode" onclick="changeMode(eraseMode)">Erase</input>
    <button onclick="resetCanvas()">Reset</button>
    <p>Plan Drills</p>


</body>


</html>