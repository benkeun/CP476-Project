var backgroundFull = new Image();
var backgroundHalf = new Image();
var drillDiv = document.getElementById('drillDiv');
var canvas = document.getElementById('drillCanvas');
var ctx = canvas.getContext('2d');
var drill;

var paint = false;
var prevClickX;
var prevClickY;

var mode = "line";
ctx.lineWidth = 5;
ctx.globalCompositeOperation = 'source-over'

circleMode = "circle";
crossMode = "cross";
lineMode = "line";
eraseMode = "erase";

function changeMode(mode) {
    this.mode = mode;
    switch (this.mode) {
        case "circle":
            ctx.globalCompositeOperation = 'source-over'
            ctx.lineWidth = 3;
            break;
        case "cross":
            ctx.globalCompositeOperation = 'source-over'
            ctx.lineWidth = 3;
            break;
        case "line":
            ctx.globalCompositeOperation = 'source-over'
            ctx.lineWidth = 5;
            break;
        case "erase":
            ctx.globalCompositeOperation = 'destination-out'
            break;
        default:
    }
}
function resetCanvas() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
}
function addClick(x, y, dragging) {
    clickX.push(x);
    clickY.push(y);
    clickDrag.push(dragging);
}
function changeBackground(image) {
    canvas.style.backgroundImage = "url(" + image + ")";
}
function redraw() {
    console.log("draw");
    ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height); // Clears the canvas
}
console.log(canvas);
canvas.onmousedown = function (e) {
    paint = true;
    console.log("here")
    prevClickX = e.pageX - this.offsetLeft;
    prevClickY = e.pageY - this.offsetTop;
    ctx.lineJoin = "round";
    switch (mode) {
        case "circle":
            ctx.strokeStyle = "#0000FF";
            break;
        case "cross":
            ctx.strokeStyle = "#FF0000";
            break;
        case "line":
            ctx.strokeStyle = "#000000";
            break;
        case "erase":
            ctx.moveTo(x, y)
            ctx.arc(prevClickX, prevClickY, 10, 0, Math.PI * 2, true);
            ctx.fill();
            break;
        default:
    }
};
canvas.onmousemove = function (e) {
    if (paint) {
        x = e.pageX - this.offsetLeft;
        y = e.pageY - this.offsetTop;
        switch (mode) {
            case "line":
                ctx.beginPath();
                ctx.moveTo(prevClickX, prevClickY);
                ctx.lineTo(x, y);
                ctx.stroke();
                prevClickX = x;
                prevClickY = y;
                ctx.closePath();
                break;
            case "erase":
                ctx.moveTo(x, y)
                ctx.arc(x, y, 10, 0, Math.PI * 2, true);
                ctx.fill();
                break;
            default:
        }
    }
};
canvas.onmouseup = function (e) {
    paint = false;
    x = e.pageX - this.offsetLeft;
    y = e.pageY - this.offsetTop;
    switch (mode) {
        case "circle":
            ctx.beginPath();
            ctx.arc(x, y, 15, 0, 2 * Math.PI);
            ctx.stroke();
            ctx.closePath();
            break;
        case "cross":
            ctx.beginPath();
            ctx.moveTo(x - 15, y - 15);
            ctx.lineTo(x + 15, y + 15);
            ctx.stroke();
            ctx.closePath();

            ctx.beginPath();
            ctx.moveTo(x - 15, y + 15);
            ctx.lineTo(x + 15, y - 15);
            ctx.stroke();
            ctx.closePath();
            break;
        default:
    }
};
canvas.onmouseleave = function (e) {
    paint = false;
};

async function addDrill() {
    let frm = new FormData();
    frm.set('canvas', canvas.toDataURL());
    frm.set('drillName', $('#drillName').val());
    frm.set('description', "No Description");
    frm.set('drillCategory', $('#drillCategory').val());
    var empty = (
        frm.get('drillName') === "" ||
        frm.get('drillCategory') === ""
    );
    console.log(empty);
    if (!empty) {
        await fetch("pages/addDrill.php", {
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

            });
    } else {
        $('#addStatus').text("Fill All Blanks");
    }
}
function loadcanvas(id) {
    let frm = new FormData();
    frm.set('canvas', canvas.toDataURL());
    frm.set('drillName', $('#drillName').val());
    frm.set('description', "No Description");
    frm.set('drillCategory', $('#drillCategory').val());
    frm.set('id', id);
    await fetch("pages/getDrills.php", {
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
            drill = text[0];

            "use strict";
            var img = new window.Image();
            img.addEventListener("load", function () {
                canvas.getContext("2d").drawImage(img, 0, 0);
            });
            img.setAttribute("src", drill['canvas']);
        });
}