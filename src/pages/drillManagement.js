var backgroundFull = new Image();
var backgroundHalf = new Image();
var drillDiv = document.getElementById('drillDiv');
var canvas = document.getElementById('drillCanvas');
var ctx = canvas.getContext('2d');

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
                break;
            case "erase":
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
            break;
        case "cross":
            ctx.beginPath();
            ctx.moveTo(x - 15, y - 15);
            ctx.lineTo(x + 15, y + 15);
            ctx.stroke();

            ctx.beginPath();
            ctx.moveTo(x - 15, y + 15);
            ctx.lineTo(x + 15, y - 15);
            ctx.stroke();
            break;
        default:
    }
};
canvas.onmouseleave = function (e) {
    paint = false;
};