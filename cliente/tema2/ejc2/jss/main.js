var users = data.map(function(userJSON){
    return new Usuario(userJSON);
});

console.log(users);

document.write("<pre>");
users.forEach(user => {
    document.write(user.name+" ("+user.email+")<br>");
    document.write("\tDinero ganado: "+ user.moneyWon()+"<br>");
    document.write("\tProductos Vendidos:<br>");
    user.productsSold().forEach(product => {
        document.write("\t\t"+product.description+" ("+product.price+"). Comprador: "+product.userSoldTo(users).name+"<br>");
    });
    document.write("\tProductos en Venta:<br>");
    user.productsNotSold().forEach(product => {
        document.write("\t\t"+product.description+" ("+product.price+").<br>");
    });
});
document.write("</pre>");