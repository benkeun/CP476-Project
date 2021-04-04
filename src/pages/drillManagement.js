var backgroundFull = new Image();
var backgroundHalf = new Image();
var drillDiv = document.getElementById('drillDiv');
var canvas = document.getElementById('drillCanvas');
var ctx = canvas.getContext('2d');

var paint = false;
var clickX = new Array();
var clickY = new Array();
var clickDrag = new Array();
var mode="lines";
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

function addClick(x, y, dragging) {
    clickX.push(x);
    clickY.push(y);
    clickDrag.push(dragging);
}
function changeBackground(image) {
        canvas.style.backgroundImage= "url("+image+")";
}
function redraw() {
    console.log("draw");
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
console.log(canvas);
canvas.onmousedown=function (e) {
    var mouseX = e.pageX - this.offsetLeft;
    var mouseY = e.pageY - this.offsetTop;
    console.log("here")
    paint = true;
    addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop);
    redraw();
};
canvas.onmousemove=function (e) {
    if (paint) {
        addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true);
        redraw();
    }
};
canvas.onmouseup=function (e) {
    paint = false;
    redraw();
};
canvas.onmouseleave=function (e) {
    paint = false;
};