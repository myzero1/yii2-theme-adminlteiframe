<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$bundle = myzero1\adminlteiframe\assets\php\components\ImgAsset::register($this);
$xkbg = sprintf('%s/img/xkbg.png', $bundle->baseUrl);

use yii\helpers\Html;

$this->title = $name;


?>


<div class="landscape"></div>
<div class="filter"></div>
<canvas id="canvas" width="1440" height="763"></canvas>

<div style="position: fixed; bottom: 0; width: 100%; line-height: 150%; background:rgba(0,0,0,0.1); border-top: 1px solid rgba(255,255,255,.1); z-index: 11000; color:rgba(255,255,255,.4); font-size: 12px; padding: 5px 0;">

    <div class="site-error">
        <h1 style="padding-left: 30px">页面提示信息</h1>

        <ol>
            <li>错误信息：<code><?= Html::encode($this->title) . nl2br(Html::encode($message)) ?></code></li>
            <li>当前url：<code><?= Yii::$app->request->getHostInfo().Yii::$app->request->url?></code></li>
            <li>当前视图路径：<code><?= __FILE__ ?></code></li>
            <li>若在主题的视图目录（<code><?= Yii::getAlias("@vendor/myzero1/yii2-theme-adminlteiframe/src/views/adminlte")?></code>）<br/>下没有找到对应视图就会在应用的视图目录（<code><?= Yii::getAlias("@app/views")?></code>）下找视图</li>
            <li>若在主题的视图目录和应用的视图目录中都有相应的视图，则先使用主题视图目录中的视图。若要使用应用视图目录中的视图，需要手动在控制器中指定。</li>
        </ol>
    </div>

</div>



<style>
    .content-wrapper{
        background: linear-gradient(to bottom,#000000 0%,#5788fe 100%);
    }
    .content{
        padding:0;
    }
    html,body {
        margin:0;
        overflow:hidden;
        width:100%;
        height:100%;
        cursor:none;
        background:black;
        background:linear-gradient(to bottom,#000000 0%,#5788fe 100%);
    }
    .filter {
        width:100%;
        height:100%;
        position:absolute;
        top:0;
        left:0;
        background:#fe5757;
        animation:colorChange 30s ease-in-out infinite;
        animation-fill-mode:both;
        mix-blend-mode:overlay;
    }
    @keyframes colorChange {
        0%,100% {
        opacity:0;
    }
    50% {
        opacity:.9;
    }
    }.landscape {
        position:absolute;
        bottom:0px;
        left:0;
        width:100%;
        height:100%;
        background-image:url('<?= $xkbg; ?>');
        background-size:1000px 250px;
        background-repeat:repeat-x;
        background-position:center bottom;
    }
</style>

<script>
function Star(id, x, y){
    this.id = id;
    this.x = x;
    this.y = y;
    this.r = Math.floor(Math.random()*2)+1;
    var alpha = (Math.floor(Math.random()*10)+1)/10/2;
    this.color = "rgba(255,255,255,"+alpha+")";
}

Star.prototype.draw = function() {
    ctx.fillStyle = this.color;
    ctx.shadowBlur = this.r * 2;
    ctx.beginPath();
    ctx.arc(this.x, this.y, this.r, 0, 2 * Math.PI, false);
    ctx.closePath();
    ctx.fill();
}

Star.prototype.move = function() {
    this.y -= .15;
    if (this.y <= -10) this.y = HEIGHT + 10;
    this.draw();
}

Star.prototype.die = function() {
    stars[this.id] = null;
    delete stars[this.id];
}


function Dot(id, x, y, r) {
    this.id = id;
    this.x = x;
    this.y = y;
    this.r = Math.floor(Math.random()*5)+1;
    this.maxLinks = 2;
    this.speed = .5;
    this.a = .5;
    this.aReduction = .005;
    this.color = "rgba(255,255,255,"+this.a+")";
    this.linkColor = "rgba(255,255,255,"+this.a/4+")";

    this.dir = Math.floor(Math.random()*140)+200;
}

Dot.prototype.draw = function() {
    ctx.fillStyle = this.color;
    ctx.shadowBlur = this.r * 2;
    ctx.beginPath();
    ctx.arc(this.x, this.y, this.r, 0, 2 * Math.PI, false);
    ctx.closePath();
    ctx.fill();
}

Dot.prototype.link = function() {
    if (this.id == 0) return;
    var previousDot1 = getPreviousDot(this.id, 1);
    var previousDot2 = getPreviousDot(this.id, 2);
    var previousDot3 = getPreviousDot(this.id, 3);
    if (!previousDot1) return;
    ctx.strokeStyle = this.linkColor;
    ctx.moveTo(previousDot1.x, previousDot1.y);
    ctx.beginPath();
    ctx.lineTo(this.x, this.y);
    if (previousDot2 != false) ctx.lineTo(previousDot2.x, previousDot2.y);
    if (previousDot3 != false) ctx.lineTo(previousDot3.x, previousDot3.y);
    ctx.stroke();
    ctx.closePath();
}

function getPreviousDot(id, stepback) {
    if (id == 0 || id - stepback < 0) return false;
    if (typeof dots[id - stepback] != "undefined") return dots[id - stepback];
    else return false;//getPreviousDot(id - stepback);
}

Dot.prototype.move = function() {
    this.a -= this.aReduction;
    if (this.a <= 0) {
        this.die();
        return
    }
    this.color = "rgba(255,255,255,"+this.a+")";
    this.linkColor = "rgba(255,255,255,"+this.a/4+")";
    this.x = this.x + Math.cos(degToRad(this.dir))*this.speed,
    this.y = this.y + Math.sin(degToRad(this.dir))*this.speed;

    this.draw();
    this.link();
}

Dot.prototype.die = function() {
    dots[this.id] = null;
    delete dots[this.id];
}


var canvas  = document.getElementById('canvas'),
    ctx = canvas.getContext('2d'),
    WIDTH,
    HEIGHT,
    mouseMoving = false,
    mouseMoveChecker,
    mouseX,
    mouseY,
    stars = [],
    initStarsPopulation = 80,
    dots = [],
    dotsMinDist = 2,
    maxDistFromCursor = 50;

setCanvasSize();
init();

window.onresize = function (){
    location.reload();
}

function setCanvasSize() {
    WIDTH = document.documentElement.clientWidth,
    HEIGHT = document.documentElement.clientHeight;                      

    canvas.setAttribute("width", WIDTH);
    canvas.setAttribute("height", HEIGHT);
}

function init() {
    ctx.strokeStyle = "white";
    ctx.shadowColor = "white";
    for (var i = 0; i < initStarsPopulation; i++) {
        stars[i] = new Star(i, Math.floor(Math.random()*WIDTH), Math.floor(Math.random()*HEIGHT));
        //stars[i].draw();
    }
    ctx.shadowBlur = 0;
    animate();
}

function animate() {
    ctx.clearRect(0, 0, WIDTH, HEIGHT);

    for (var i in stars) {
        stars[i].move();
    }
    for (var i in dots) {
        dots[i].move();
    }
    drawIfMouseMoving();
    requestAnimationFrame(animate);
}

window.onmousemove = function(e){
    mouseMoving = true;
    mouseX = e.clientX;
    mouseY = e.clientY;
    clearInterval(mouseMoveChecker);
    mouseMoveChecker = setTimeout(function() {
        mouseMoving = false;
    }, 100);
}


function drawIfMouseMoving(){
    if (!mouseMoving) return;

    if (dots.length == 0) {
        dots[0] = new Dot(0, mouseX, mouseY);
        dots[0].draw();
        return;
    }

    var previousDot = getPreviousDot(dots.length, 1);
    var prevX = previousDot.x; 
    var prevY = previousDot.y; 

    var diffX = Math.abs(prevX - mouseX);
    var diffY = Math.abs(prevY - mouseY);

    if (diffX < dotsMinDist || diffY < dotsMinDist) return;

    var xVariation = Math.random() > .5 ? -1 : 1;
    xVariation = xVariation*Math.floor(Math.random()*maxDistFromCursor)+1;
    var yVariation = Math.random() > .5 ? -1 : 1;
    yVariation = yVariation*Math.floor(Math.random()*maxDistFromCursor)+1;
    dots[dots.length] = new Dot(dots.length, mouseX+xVariation, mouseY+yVariation);
    dots[dots.length-1].draw();
    dots[dots.length-1].link();
}
//setInterval(drawIfMouseMoving, 17);

function degToRad(deg) {
    return deg * (Math.PI / 180);
}
</script>

