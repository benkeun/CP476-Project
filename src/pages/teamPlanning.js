var lines;
var type = document.getElementById("lineupType");
var line = document.getElementById("lineNum");

var leftWing = document.getElementById("leftWingSpan");
var rightWing = document.getElementById("rightWingSpan");
var center = document.getElementById("centerSpan");
var leftDefense = document.getElementById("leftDefenseSpan");
var rightDefense = document.getElementById("rightDefenseSpan");

var spans=[leftWing,rightWing,center,leftDefense,rightDefense];

var leftWingName = document.getElementById("leftWingName");
var rightWingName = document.getElementById("rightWingName");
var centerName = document.getElementById("centerName");
var leftDefenseName = document.getElementById("leftDefenseName");
var rightDefenseName = document.getElementById("rightDefenseName");

var names=[leftWingName,rightWingName,centerName,leftDefenseName,rightDefenseName];
fetch("pages/getLines.php", {
    method: 'POST',
})
    .then(function (response) {
        let text;
        try {
            text = response.json();
        }
        catch (e) {
            text = e.message;;
        }
        return text;
    })
    .then(function (text) {
        lines = text;
        displayLine();
    });

function displayLine() {

    var newLine = lines.filter(obj => {
        return obj.lineup_type === type.value && obj.line_num === line.value
    });
    if (newLine.length != 0) {
        newLine.forEach(function (curLine) {
            if (curLine.position === "Right Wing") {
                rightWing.textContent = curLine.player_num;
                rightWingName.children[1].textContent = curLine.first_name +" "+ curLine.last_name;
                rightWingName.children[2].textContent=curLine.player_num;
            }
            else if (curLine.position === "Left Wing") {
                leftWing.textContent = curLine.player_num;
                leftWingName.children[1].textContent = curLine.first_name +" "+curLine.last_name;
                leftWingName.children[2].textContent=curLine.player_num;
            }
            else if (curLine.position === "Center") {
                center.textContent = curLine.player_num;
                centerName.children[1].textContent = curLine.first_name +" "+curLine.last_name;
                centerName.children[2].textContent=curLine.player_num;
            }
            else if (curLine.position === "Left Defense") {
                leftDefense.textContent = curLine.player_num;
                leftDefenseName.children[1].textContent = curLine.first_name +" "+ curLine.last_name;
                leftDefenseName.children[2].textContent=curLine.player_num;
            }
            else if (curLine.position === "Right Defense") {
                rightDefense.textContent = curLine.player_num;
                rightDefenseName.children[1].textContent = curLine.first_name+" "+curLine.last_name;
                rightDefenseName.children[2].textContent=curLine.player_num;
            }
        }
        );
    } else {
        spans.forEach(function(span){
            span.textContent=-1;
        });
        names.forEach(function(name){
        name.children[1].textContent = "";
        name.children[2].textContent="";
        });
    }
}
