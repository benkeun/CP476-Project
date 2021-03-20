var backgroundFull = new Image();
var backgroundHalf = new Image();
var canvas = document.getElementById('drillCanvas');
var ctx = canvas.getContext('2d');   
backgroundFull.src = "images/ice.jpg";
backgroundFull.onload = function(){
    ctx.drawImage(backgroundFull,0,0);
};
backgroundHalf.src = "images/halfIce.jpg";
function changeBackground(image){
    ctx.clearRect(0,0,1200,550);
    ctx.drawImage(image,0,0);
    
}
