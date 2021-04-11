var lines;
var players;
var type = document.getElementById("lineupType");
var line = document.getElementById("lineNum");

var editType = document.getElementById("customLineupType");
var editLine = document.getElementById("customLineNum");

var leftWing = document.getElementById("leftWingSpan");
var rightWing = document.getElementById("rightWingSpan");
var center = document.getElementById("centerSpan");
var leftDefense = document.getElementById("leftDefenseSpan");
var rightDefense = document.getElementById("rightDefenseSpan");

var spans = [leftWing, rightWing, center, leftDefense, rightDefense];

var leftWingName = document.getElementById("leftWingName");
var rightWingName = document.getElementById("rightWingName");
var centerName = document.getElementById("centerName");
var leftDefenseName = document.getElementById("leftDefenseName");
var rightDefenseName = document.getElementById("rightDefenseName");
var names = [leftWingName, rightWingName, centerName, leftDefenseName, rightDefenseName];

var leftSelect = document.getElementById("leftSelect");
var rightSelect = document.getElementById("rightSelect");
var centerSelect = document.getElementById("centerSelect");
var leftDSelect = document.getElementById("leftDSelect");
var rightDSelect = document.getElementById("rightDSelect");
getLines();
getPlayers();

var oldName = "";
function getPlayers() {
    fetch("pages/getPlayers.php", {
        method: 'POST',
    })
        .then(function (response) {
            let text;
            try {
                text = response.json();
                console.log(text);
            }
            catch (e) {
                text = e.message;;
            }
            return text;
        })
        .then(function (text) {
            players = text;
            console.log("Players Stored in browser are: "+JSON.stringify(players));
        });
}

function getLines() {
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
}
function displayLine() {

    var newLine = lines.filter(obj => {
        return obj.lineup_type === type.value && obj.line_num === line.value
    });
    if (newLine.length != 0) {
        newLine.forEach(function (curLine) {
            if (curLine.position === "Right Wing") {
                rightWing.textContent = curLine.player_num;
                rightWingName.children[1].textContent = curLine.first_name + " " + curLine.last_name;
                rightWingName.children[2].textContent = curLine.player_num;
            }
            else if (curLine.position === "Left Wing") {
                leftWing.textContent = curLine.player_num;
                leftWingName.children[1].textContent = curLine.first_name + " " + curLine.last_name;
                leftWingName.children[2].textContent = curLine.player_num;
            }
            else if (curLine.position === "Center") {
                center.textContent = curLine.player_num;
                centerName.children[1].textContent = curLine.first_name + " " + curLine.last_name;
                centerName.children[2].textContent = curLine.player_num;
            }
            else if (curLine.position === "Left Defense") {
                leftDefense.textContent = curLine.player_num;
                leftDefenseName.children[1].textContent = curLine.first_name + " " + curLine.last_name;
                leftDefenseName.children[2].textContent = curLine.player_num;
            }
            else if (curLine.position === "Right Defense") {
                rightDefense.textContent = curLine.player_num;
                rightDefenseName.children[1].textContent = curLine.first_name + " " + curLine.last_name;
                rightDefenseName.children[2].textContent = curLine.player_num;
            }
        }
        );
    } else {
        spans.forEach(function (span) {
            span.textContent = -1;
        });
        names.forEach(function (name) {
            name.children[1].textContent = "";
            name.children[2].textContent = "";
        });
    }
}
function generateLines(typeToGen) {
    let frm = new FormData();
    frm.set('type', typeToGen);
    frm.set('lineNum', -1);
    fetch("pages/generateLine.php", {
        method: 'POST',
        body: frm
    })
        .then(function (response) {
            let text;
            try {
                text = response.text();
            }
            catch (e) {
                text = e.message;;
            }
            return text;
        })
        .then(function (text) {
            console.log(text);
            if (parseInt(text) >= 1) {
                getLines();
                type.value = typeToGen;
                line.value = 1;
                displayLine();
            }
        });
}
function editDisplays() {
    var nameInput = document.getElementById("lineName");
    document.getElementById("myModal").style.display = "block";
    if (editType.value === "New") {
        nameInput.disabled = false;
    } else {
        nameInput.disabled = true;
    }
    nameInput.value = (editType.value);
    oldName = editType.value;
    html = ["", "", "", "", ""]
    var newLine = lines.filter(obj => {
        return obj.lineup_type === editType.value && obj.line_num===editLine.value;
        
    });

    players.forEach(function (player) {
        if (player.position === "Right Wing") {

            html[0] += "<option value='" + player.number + "'>" + player.number + " " + player.first_name + " " + player.last_name + "</option>";
        }

        else if (player.position === "Left Wing") {
            html[1] += "<option value='" + player.number + "'>" + player.number + " " + player.first_name + " " + player.last_name + "</option>";
        }
        else if (player.position === "Center") {
            html[2] += "<option value='" + player.number + "'>" + player.number + " " + player.first_name + " " + player.last_name + "</option>";
        }
        else if (player.position === "Left Defense") {
            html[3] += "<option value='" + player.number + "'>" + player.number + " " + player.first_name + " " + player.last_name + "</option>";
        }
        else if (player.position === "Right Defense") {
            html[4] += "<option value='" + player.number + "'>" + player.number + " " + player.first_name + " " + player.last_name + "</option>";
        }

    });
    rightSelect.innerHTML = html[0];
    leftSelect.innerHTML = html[1];
    centerSelect.innerHTML = html[2];
    leftDSelect.innerHTML = html[3];
    rightDSelect.innerHTML = html[4];
    if (newLine.length != 0) {
        newLine.forEach(function (curLine) {
            if (curLine.position === "Right Wing") {
               rightSelect.value= curLine.player_num;
            }
    
            else if (curLine.position === "Left Wing") {
                leftSelect.value= curLine.player_num;
            }
            else if (curLine.position === "Center") {
                centerSelect.value= curLine.player_num;
            }
            else if (curLine.position === "Left Defense") {
                leftDSelect.value= curLine.player_num;
            }
            else if (curLine.position === "Right Defense") {
                rightDSelect.value= curLine.player_num;
            }
        });
    }

}
function updateLine(deleteLine) {
    var newName = document.getElementById("lineName").value;
    if (oldName=="New"){
    type.add(new Option(newName, newName));
    }
    if (newName!=="New"){
    let frm = new FormData();
    frm.set('type', oldName);
    frm.set('delete', deleteLine);
    frm.set('newName', newName);
    frm.set('lineNum', editLine.value);
    frm.set('players', JSON.stringify([leftSelect.value, rightSelect.value, centerSelect.value, leftDSelect.value, rightDSelect.value]));
    fetch("pages/generateLine.php", {
        method: 'POST',
        body: frm
    })
        .then(function (response) {
            let text;
            try {
                text = response.text();
            }
            catch (e) {
                text = e.message;;
            }
            return text;
        })
        .then(function (text) {
            console.log(text);
            if (parseInt(text) >= 1) {
                getLines();
                document.getElementById("status").textContent="Line Updated Successfully";
                type.value=editType.value;
                line.value=editLine.value;
            }
        });
}else{
    document.getElementById("status").textContent="Please Change Name";
}
}
// Get the modal
var modal = document.getElementById("myModal");

var span = document.getElementsByClassName("close")[0];


span.onclick = function () {
    modal.style.display = "none";
}


// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
