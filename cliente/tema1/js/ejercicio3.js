console.log("EJERCICIO 3=========================================");

var arry = new Array("patata",2,true,'9',7,false,"9",'melocoton');
console.log(arry);

var arry2 = arry.map(function(val){
    return Number(val)
});
var arry3 = arry2.filter(function(val){
    return !isNaN(val)
});


console.log(arry2);
console.log(arry3);