var backgroundFull = new Image();
var backgroundHalf = new Image();
var drillDiv = document.getElementById('drillDiv');
var canvas = document.getElementById('drillCanvas');
var ctx = canvas.getContext('2d');

var paint = false;
var clickX = new Array();
var clickY = new Array();
var clickDrag = new Array();
backgroundFull.src = "images/ice.jpg";
backgroundHalf.src = "images/halfIce.jpg";
var mode;
circleMode = "circle";
crossMode = "cross";
linesMode = "lines";
eraseMode = "erase";

function changeMode(mode){
    switch(mode){
        case "circle":
            this.mode = mode;
            break;
        case "cross":
            this.mode = mode;
            break;
        case "lines":
            this.mode = mode;
            break;
        case "erase":
            this.mode = mode;
            break;
        default:

    }
}

backgroundFull.onload = function () {
    ctx.drawImage(backgroundFull, 0, 0);
};
function addClick(x, y, dragging) {
    clickX.push(x);
    clickY.push(y);
    clickDrag.push(dragging);
}
function changeBackground(image) {
    ctx.clearRect(0, 0, 1200, 550);
    ctx.drawImage(image, 0, 0);
}
function redraw() {
    ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height); // Clears the canvas

    ctx.strokeStyle = "#df4b26";
    ctx.lineJoin = "round";
    ctx.lineWidth = 5;

    for (var i = 0; i < clickX.length; i++) {
        ctx.beginPath();
        if (clickDrag[i] && i) {
            ctx.moveTo(clickX[i - 1], clickY[i - 1]);
        } else {
            ctx.moveTo(clickX[i] - 1, clickY[i]);
        }
        ctx.lineTo(clickX[i], clickY[i]);
        ctx.closePath();
        ctx.stroke();
    }
}

$('#canvas').mousedown(function (e) {
    var mouseX = e.pageX - this.offsetLeft;
    var mouseY = e.pageY - this.offsetTop;

    paint = true;
    addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop);
    redraw();
});
$('#canvas').mousemove(function (e) {
    if (paint) {
        addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true);
        redraw();
    }
});
$('#canvas').mouseup(function (e) {
    paint = false;
    redraw();
});
$('#canvas').mouseleave(function (e) {
    paint = false;
});