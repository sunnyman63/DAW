var camiseta = {
    precio: 10,
    descripcion: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere non amet quibusdam, laboriosam ea odio repellat? Quasi aliquid, dolorum natus, provident ullam distinctio non praesentium reprehenderit fugiat, rem fuga at!"
}

var carrito = {
    camisetas: [],

    //añadir camisetas al carrito
    anyadir:function(color) {
        let cami = {
            color: color,
            precio: camiseta.precio,
            cantidad: 1,
            descripcion: camiseta.descripcion,
        }
        let esta = false;
        let index = 0;
        this.camisetas.forEach(cam => {
            if(cam.color == color) {
                esta = true;
                index = this.camisetas.indexOf(cam);
            }
        });
        if(esta) {
            this.camisetas[index].cantidad++;
        } else {
            this.camisetas.push(cami);
        }
        carrito.actualizarCarrito();
    },

    //Eliminar camisetas del carrito
    eliminar:function(color) {
        let cant = 0;
        let index = 0;
        this.camisetas.forEach(cam => {
            if(cam.color == color) {
                cant = cam.cantidad;
                index = this.camisetas.indexOf(cam);
            }
        });
        if(cant > 1) {
            this.camisetas[index].cantidad--;
        } else {
            this.camisetas.splice(index,1);
        }
        carrito.actualizarCarrito();
    },

    //Actializar visor del carrito
    actualizarCarrito:function() {
        $(".listado").html("");
        let ptotal = 0;
        this.camisetas.forEach(cami => {
            ptotal += cami.precio * cami.cantidad;
            $(".listado").append(
                "<li data-color='"+cami.color+"'> Camiseta " + cami.color + " " + cami.precio * cami.cantidad + " €" +
                    "<div class='funcionalidadProducto'>"+
                        "<button class='btnRestar'>-</button>"+
                        "<label>"+cami.cantidad+"</label>"+
                        "<button class='btnSumar'>+</button>"+
                    "</div>"+
                "</li>"
            );
            //Restar al carrito
            $(".btnRestar").on("click",function() {
                var li = $(this.parentElement.parentElement).data("color");
                carrito.eliminar(li);
            });
            //Añadir al carrito
            $(".btnSumar").on("click",function() {
                var li = $(this.parentElement.parentElement).data("color");
                carrito.anyadir(li);
            });
        });
        $(".pTotal").text(ptotal);
    }
}

//cambiar de camiseta seleccionada
$(".camisetasMini").on("click",function() {
    var color = $(this).data("color");
    $(".camisetaImg").fadeOut();
    setTimeout(function(){
        $(".camisetaImg").attr("src","./img/camiseta/large/"+color+".jpg");
        $(".camisetaSelect").text(color);
        $(".infoCamiSelect").find("p").text(camiseta.descripcion);
        $(".camisetaImg").fadeIn();
    },500);
    
});

//Comprar una camiseta 
$(".btnComprar").on("click",function() {
    let color = $(".camisetaSelect").text();
    carrito.anyadir(color);
    carrito.actualizarCarrito();
});


