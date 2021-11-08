// cargar productos del backend
$(function () {

    var stripe = Stripe('pk_test_51JF5DuEhw8eLdPcf6L8aDBJEIfEVao611sbel1ymRHng6XMQHJU0R0ShhDBZUjW6r9ky0lUsKfXEDDeIYIUYKaxQ00CIfeWnFg');

    $.ajax({
        url: "../servidor/api/getProductos.php",
        success: (productos) => {
            productos.forEach(producto => {
                $("#productos").append(
                    `<div class="text-center col-lg-3 mt-5">
                        <div class="card">
                            <img src="${producto.foto}" class="card-img-top">
                            <h5 class="card-header">${producto.marca}</h5>
                            <div class="card-body">
                                <h5 class="card-title">${producto.nombre}</h5>
                                <p class="card-text" style="height: 130px;">${producto.descripcion}</p>
                                <a href="#" class="btn btn-primary checkout" data-id-producto="${producto.id}">Comprar</a>
                            </div>
                            <div class="card-footer text-muted">
                                <s>${(producto.precio_anterior)? format(producto.precio_anterior) : ""}</s> 
                                <strong>${format(producto.precio)}</strong>
                            </div>
                        </div>
                    </div>`
                )
            })

            $(".checkout").on("click", function(e) {
                e.preventDefault()
                $.ajax({
                    url: "../servidor/api/crearCheckout.php",
                    type: "POST",
                    data: {
                        'producto': $(this).data("id-producto")
                    },
                    success: function(respuesta) {
                        stripe.redirectToCheckout({
                            sessionId: respuesta.id
                        })
                    }
                })
            })
        }
    })
})

// formatear precios
// ejemplo: 1000 => $10.00
function format(precio) {
    return Intl.NumberFormat("es-MX", {
        style: "currency",
        currency: "MXN",
      }).format(precio / 100)
}