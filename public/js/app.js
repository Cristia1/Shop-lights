const APP_URL = window.location.origin;

$(document).ready(function () {
    // console.log('intra');
    // asta ia domeniul aplicatiei
    
    $('#add-to-card-button').click(function () {
        // $('#index-card-items').val();

        let product_id = $(this).attr('product_id');
        $.ajax({
            url: APP_URL + '/orders/add-to-cart/' + product_id,
            type: 'GET',

            success: function (response) {
                $('#index-card-items').text(response.cartCount);
                // console.log($product_id);
            },

            error: function (xhr, status, error) {
                console.log(xhr.responseText);

            }
        });
    });
    getCountOrders();
    setInterval(getCountOrders, 5000);
});


function getCountOrders() {
    $.ajax({
        url: '/orders/add-to-cart', 
        type: 'GET',
        success: function (response) {
            $('#index-card-items').text(response['index-card-items']);
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}

