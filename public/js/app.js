$(document).ready(function() {
    $('#addtocart').click(function() {

        var name = $('#name').val();
        var price = $('#price').val();
        var quantity = $('#quantity').val();
        var data = {

            name: name,
            price: price,
            quantity: quantity
        };

        $.ajax({
            url: 'http://localhost:8000/api/orders/add-to-cart', // Modificarea URL-ului
            type: 'GET',
            data: data,

            success: function(response) {
                $('.cart-count').text(response.cartCount);
                console.log(response,'aici este ');
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            },
        });
    });
});
