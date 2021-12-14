function Usuario(user) {
    this.id = user.id;
    this.name = user.name;
    this.email = user.email;
    this.products = user.products.map(product => new Producto(product));
}

Usuario.prototype.productsSold = function() {
    let productosVendidos = this.products.filter(product => product.isSold() == true);
    return productosVendidos;
}

Usuario.prototype.productsNotSold = function() {
    let productosNoVendidos = this.products.filter(product => product.isSold() == false);
    return productosNoVendidos;
}

Usuario.prototype.moneyWon = function() {
    let dinero = this.productsSold().reduce((money,product)=>{
        return money + product.price;;
    },0);
    return dinero;
}