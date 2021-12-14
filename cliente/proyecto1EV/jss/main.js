var obj = document.querySelector("#cabesa");
var posXcabesa = 200;
var posYcabesa = 300;
var velocidad = 5;

var start = Date.now();
var timePassedOld = posXcabesa*5;

var timer = setInterval(function() {
    let timePassed = Date.now() - start;
    console.log(timePassed);
    if(timePassed >= timePassedOld+(velocidad*100)) {
        posXcabesa = timePassed/5;
        obj.style.left = posXcabesa + 'px';
        timePassedOld = timePassed;
    }
    if (timePassed/5 >= window.innerWidth) {
        obj.style.left = window.innerWidth-100;
        clearInterval(timer);
    }
}, 20);
