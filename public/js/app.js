$(document).ready(function () {
    // asta ia domeniul aplicatiei
    const APP_URL = window.location.origin;

    $('#add-to-card-button').click(function () {
        // $('#index-card-items').val();
        let product_id = $(this).attr('product_id');
        $.ajax({
            url: APP_URL + '/orders/add-to-cart/' + product_id,
            type: 'get',

            success: function (response) {
                $('#index-card-items').text(response.cartCount);
             console.log(response);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });

    /*aci trebuie sa imi faci un ajax care se trigarueste atunci cand se incarca pagina care imi updateaza elementul #index-card-items cu numarul total de valori in orders*/



});
