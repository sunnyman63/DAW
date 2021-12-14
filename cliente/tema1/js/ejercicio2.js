console.log("EJERCICIO 2=========================================");


var arry = new Array("patata",2,true,'9',7,false,"9",'melocoton');
console.log(arry);

var arry2 = [];

for(var a = 0;a<arry.length;a++){
    var b = Number(arry[a]);
    if(!isNaN(b)){
        arry2.push(b);
    }
}

console.log(arry2);