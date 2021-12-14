function Producto(product) {
    this.description = product.description;
    this.id = product.id;
    this.price = product.price;
    if(product.soldTo){
        this.soldTo = product.soldTo;
    }
    
}

Producto.prototype.isSold = function() {
    if(typeof this.soldTo == "number"){
        return true;
    }else{
        return false;
    }
}

Producto.prototype.userSoldTo = function(users) {
    let user = users.filter(user => user.id === this.soldTo,this);
    if(!users || !this.isSold() || !Array.isArray(users)) {
        return null;
    }
        return user[0] || null;
}
