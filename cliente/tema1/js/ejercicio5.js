console.log("EJERCICIO 5=========================================");


//Crea un array con 4 elementos

var arry = new Array(1,2,3,4);
console.log(arry.join());

//Concatena 2 elementos más al final y 2 al principio

arry.unshift(-1,0);
arry.push(5,6);
console.log(arry.join());

//Elimina las posiciones de la 3 a la 5 (incluida)

arry.splice(3,3);
console.log(arry.join());

//Inserta 2 elementos más entre el penúltimo y el último

arry.splice(arry.length-1,0,"A");
console.log(arry.join());

//Muestra el array del paso anterior, pero con los elementos separados por "==>"

console.log(arry.join("==>"));