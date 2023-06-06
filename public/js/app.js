
$(document).ready(function() {
    $('#product').click(function() { // Modificarea selectorului la '#product'
        var id_order = $('#id_order').val();
        var name = $('#name').val();
        var price = $('#price').val();
        var quantity = $('#quantity').val();
        var data = {
            id_order: id_order,
            name: name,
            price: price,
            quantity: quantity
        };

        $.ajax({
            url: 'http://localhost:8000/api/orders/add-to-cart',
            type: 'PUT',
            data: data,
            success: function(response) {
                $('.cart-count').text(response.cartCount);
                console.log('Primeste bine eeeeeee');

            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                console.log('intra in eroare ');

            },
        });
    });
});
